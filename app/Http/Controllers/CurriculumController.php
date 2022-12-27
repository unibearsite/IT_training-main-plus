<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Lesson;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;    //追記
use App\Notifications\SendSlack;    //追記
use Illuminate\Notifications\Messages\SlackMessage;    //追記
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class  EstimateController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
}


class CurriculumController extends Controller
{
    use Notifiable;

    // 個postの表示
    public function showPost(Request $request)
    {
        if (!empty(Auth::user()->id)) {
            $posts = Post::where('slug', '=', $request->slug)->firstOrFail();
            return view('post', compact('posts'));
        } else {
            return redirect()->route('login');
        }
    }



    // 前のチャプターボタン
    public function prevPost(Request $request)
    {
        $lastpost = Post::where('course_id', $request->course_id)->max('chapter_id');
        $chapter_id = $request->chapter_id - 2;
        $course_id = Auth::user()->course_id;

        $lessons = Lesson::where('course_id', $request->course_id)->get();

        // 前ののpostのタイトル名を取得
        $posts = Post::where('chapter_id', $request->chapter_id)->firstOrFail();

        $url= "/lessons/$posts->slug";
        return redirect($url)->with('posts','url');
    }



    // 次へ進むボタン
    public function nextPost(Request $request)
    {
        $lastpost = Post::where('course_id', $request->course_id)->max('chapter_id');
        $chapter_id = $request->chapter_id - 1;
        $course_id = Auth::user()->course_id;

        // コース内の最後のレッスンだった時
        if ($lastpost <= $chapter_id) {
            $lessons = Lesson::where('course_id', $request->course_id)->get();
            // トレーニング終わったらメッセージ表示
            return redirect()->route('home')->with('success', 'このコースのレッスンは以上です！お疲れ様でした！');
            // 引き続き同じレッスンだった時
        } else {
            // つぎのpostのタイトル名を取得
            session()->flash('success', '次のチャプターへ進みました！');
            $posts = Post::where('chapter_id', $request->chapter_id)->firstOrFail();
            $url= "/lessons/$posts->slug";
            // return view('post', compact('posts','nextSlug'));
            return redirect($url)->with('posts','url');
        }
    }
    
    
    
    // できたボタン押下で進捗度合い増やす、次のチャプターへ遷移
    public function successChapter(Request $request)
    {
        $lastpost = Post::where('lesson_id', $request->lesson_id)->max('chapter_id');
        $user = Customer::find($request->id);
        $chapter_id = $request->chapter_id;
        $user->chapter_id = $chapter_id;
        $lastcourse = Post::where('course_id', $request->course_id)->max('chapter_id');
        
        if ($request->chapter_id == 50) {
            // 50は課題だから最後なのでlesson＋しない
            $user->lesson_id = $user->lesson_id;
        } else if ($lastpost == $request->chapter_id) {
            //レッスンの最後ならユーザーのlesson+1する
            $user->lesson_id = $user->lesson_id + 1;
        }
        $user->save();
        
        if ($request->chapter_id == 50) {
            $lessons = Lesson::where('course_id', $request->course_id)->get();
            // トレーニング終わったらメッセージ表示
            return redirect()->route('home')->with('success', 'このコースのレッスンは以上です！お疲れ様でした！');
        } else if ($lastcourse == $chapter_id) {
            return redirect()->route('home')->with('success', 'このコースのレッスンは以上です！お疲れ様でした！');
            // 引き続き同じレッスンだった時
        } else {
            // つぎのpostのタイトル名を取得
            session()->flash('success', '次のチャプターへ進みました！');
            $posts = Post::where('chapter_id', $request->chapter_id + 1)->firstOrFail();
        }
        // return view('post', compact('user', 'posts'));
        $url= "/lessons/$posts->slug";
        return redirect($url)->with('posts','url');
    }
    
}

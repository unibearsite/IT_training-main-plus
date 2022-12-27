<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\Slack;
use Illuminate\Notifications\Notifiable;
use App\Repositories\Slack\SlackRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendSlack;    //追記
use Illuminate\Notifications\Messages\SlackMessage;    //追記
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Customer;
use App\Models\Lesson;
use App\Models\Course;
use Google\Service\ShoppingContent\Resource\Pos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::where('course_id', Auth::user()->course_id)->get();

        $post_count = DB::table('posts')
            ->select('lesson_id', DB::raw('count(chapter_id) as count'))
            ->groupBy('lesson_id')
            ->get();

        $lessons = Lesson::where('course_id', Auth::user()->course_id)->get();
        return view('lesson_list', compact('posts', 'post_count', 'lessons'));
    }

    // トレーニングコース表示
    public function showCourse(Request $request)
    {
        $posts = Post::where('course_id', $request->course_id)->get();
        $lessons = Lesson::where('course_id', $request->course_id)->get();
        $post_count = DB::table('posts')
        ->select('lesson_id', DB::raw('count(chapter_id) as count'))
        ->groupBy('lesson_id')
        ->get();

        // ログイン中のユーザーのコースid取得
        $course_id = Auth::user()->course_id;
        if ($request->course_id <= $course_id) {
            return view('lesson_list', compact('posts','post_count', 'lessons'));
        } else {
            return redirect()->route('home')->with('message', 'こちらのコースは開放されていません。');
        }
    }

    // マイページ
    public function showMypage()
    {
        $posts   = Post::select('course_name')->distinct()->get();
        $lessons = Lesson::select('course_id', 'lesson_id', 'title')->distinct()->get();
        $courses = Course::all();
        return view('mypage', compact('posts', 'lessons', 'courses'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Lesson;
use Google\Service\CustomSearchAPI\Search as CustomSearchAPISearch;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
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
    public function result( Request $request)
    {
        $searchResults = (new Search())
                    // C 検索するモデル名と、カラムを指定
                    ->registerModel(Post::class, 'body')
                    ->perform($request->input('query'));
 
        return view('search.index', compact('searchResults'));
    }
}

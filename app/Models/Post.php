<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Post extends Model implements Searchable
{

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'lesson_id',
        'course_id',
        'course_name',
        'title',
        'chapter_id',
        'body',
        'image',
        'slug',
    ];

    // タグ見てreturn
    public static function getCaption($target_str)
    {
        preg_match_all('/<(h[23])>((?<=<h[23]>).*?(?=<\/h[23]>))<\/h[23]>/', $target_str, $array_result, PREG_SET_ORDER);
        return $array_result;
    }

    public static function getContentHtml($target_str)
    {
        $array_result = self::getCaption($target_str);
        $result_str = $target_str;

        foreach ($array_result as $tag) {
            $replace = '<' . $tag[1] . ' id="' . $tag[2] . '">' . $tag[2] . '</' . $tag[1] . '>';
            $result_str = str_replace($tag[0], $replace, $result_str);
        }
        return $result_str;
    }

    public static function getChapter_id()
    {
        $chapter_id = Post::max('chapter_id');
        return $chapter_id;
    }
    public function getSearchResult(): SearchResult
    {
        // A.検索結果のリンク先となるルートを入れる
        $url = route('show.post', $this->title);


        return new SearchResult(
            $this,
            //    B.検索結果で表示したいカラムを入れる
            $this->title,
            // $this->slug,
            $url
        );
    }
    public static function getCount()
    {
        $chapter_count = Post::where('lesson_id', 1)->count('chapter_id');
        return $chapter_count;
    }

    // １対１ belongsTo設定
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}

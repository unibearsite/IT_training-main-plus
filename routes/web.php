<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SlackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SpreadSheetController;
use App\Http\Controllers\HomeController;
use TCG\Voyager\Facades\Voyager;
use App\Models\Post;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Customer;
use App\Models\Contact;

// laravel/ui自動生成
Auth::routes();

/* ログイン後の画面 Lessonを表示 */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// コース選択したとき
Route::post('/course', [HomeController::class, 'showCourse'])->name('show.course');

// 投稿の一つを見る
Route::get('/lessons/{slug}', [CurriculumController::class, 'showPost'])->name('show.post');

// 出来たボタン押下処理
Route::post('/completion/{slug}', [CurriculumController::class, 'successChapter'])->name('success.lesson');
// 前のチャプターボタン
Route::post('/prev', [CurriculumController::class, 'prevPost'])->name('prev.post');
// 次へ進むボタン
Route::post('/next', [CurriculumController::class, 'nextPost'])->name('next.post');



// 管理ページ
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// ランキングページ
Route::get('/ranking', App\Http\Controllers\rankingController::class)->name('show.ranking');

// メンタリングページ,送信
Route::get('/meeting', function () {
    return view('contact.meeting');
});
Route::post('/meeting', [ContactController::class, 'meetingSend'])->name('send.meeting');

// ウィークリーページ,送信
Route::get('/report', [ContactController::class, 'showReport'])->name('show.report');
Route::post('/report', [ContactController::class, 'sendReport'])->name('send.report');

// お問い合わせページ,送信
Route::get('/contact', [ContactController::class, 'showContact'])->name('show.contact');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('send.contact');

//マイページ表示
Route::get('/mypage', [HomeController::class, 'showMypage'])->name('show.mypage');

// 検索
// Route::get('/search', [SearchController::class, 'index'])->name('search.index');
// Route::get('/search/result', [SearchController::class, 'result'])->name('search.result');


// Route::get('/lessons', function () {
//     return view('search.index');
// })->name('search.done');

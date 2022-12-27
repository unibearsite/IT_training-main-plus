<?php

namespace App\Http\Controllers;


use App\Http\Requests\ContactRequest;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\MeetingRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;    //追記
use App\Notifications\SendSlack;    //追記
use App\Notifications\SendMeeting;    //追記
use Illuminate\Notifications\Messages\SlackMessage;    //追記
use Illuminate\Support\Facades\Redirect;
use App\Models\SpreadSheet;

class ContactController extends Controller
{
    use Notifiable;

    // コンタクトページ表示
    public function showContact()
    {
        return view('contact.contact');
    }

    // 問い合わせ→スプレッド、Slack
    public function sendContact(ContactRequest $request)
    {
        $form = $request->all();

        $request->session()->regenerateToken();
        $contact = new Contact;
        // $contact->fill($form)->save();
        $slack = $this->notify(new SendSlack($request->user_name, $request->title, $request->message, $request->created_at));

        session()->flash('success', 'お問い合わせを送信しました！');

        // スプレッドシートに格納するテストデータです
        $insert_data = [
            'title' => $request->title,
            'user_name' => $request->user_name,
            'message'  => $request->message,
            'created_at'  => $request->created_at,
        ];

        $contact->insert_spread_sheet($insert_data);


        return back();
    }

    // メンタリング→スプレッド、Slack
    public function meetingSend(MeetingRequest $request)
    {
        $request->session()->regenerateToken();
        $spread_sheet = new SpreadSheet;
        $slack = $this->notify(new SendMeeting($request->user_name, $request->perpose, $request->date1, $request->date2, $request->date3, $request->message));
        session()->flash('success', 'メンタリング希望日を送信しました！');

        // スプレッドシートに格納するデータです
        $meeting_insert_data = [
            'user_name' => $request->user_name,
            'perpose' => $request->perpose,
            'date1'  => $request->date1,
            'date2'  => $request->date2,
            'date3'  => $request->date3,
            'message'  => $request->message,
            'created_at'  => $request->created_at,
        ];

        $spread_sheet->meeting_spread_sheet($meeting_insert_data);
        $request->session()->regenerateToken();
        return back();
    }

    // 週報ページ表示
    public function showReport()
    {
        if (!empty(Auth::user()->course_id)) {
            $posts = Post::select('course_name')->distinct()->get();
            $lessons = Lesson::select('course_id', 'lesson_id', 'title')->distinct()->get();
            return view('contact.report', compact('posts', 'lessons'));
        } else {
            return redirect()->route('login');
        }
    }
    // 週報→スプレッド
    public function sendReport(ReportRequest $request)
    {
        $spread_sheet = new SpreadSheet;
        $form = $request->all();

        // スプレッドシートに格納するテストデータ
        $insert_data = [
            'created_at' => $request->created_at,
            'user_name' => $request->user_name,
            'course_name' => $request->course_name,
            'now_lesson'  => $request->now_lesson,
            'time'  => $request->time,
            'learn'  => $request->learn,
            'trouble'  => $request->trouble,
            'comment'  => $request->comment,
        ];

        $spread_sheet->report_spread_sheet($insert_data);
        session()->flash('success', '週報を送信しました！');
        $request->session()->regenerateToken();
        return back();
    }

    // Slackへのメッセージ送信
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_url');
    }
}
<?php

namespace App\Notifications;

use App\Models\Chat;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SendMeeting extends Notification
{
    use Queueable;
    protected $user_name;
    protected $tate;
    protected $channel;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_name, $perpose, $date1, $date2, $date3, $message)
    {
        $this->user_name = $user_name;
        $this->perpose = $perpose;
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->date3 = $date3;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];    //編集
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('メンタリングの申し込みが届きました。日程の確定をお願いします。' . "\n"
                . '【名前】' . "\n" . $this->user_name  . "\n"
                . '【目的】' . "\n" . $this->perpose  . "\n"
                . '【第1希望日】' . "\n" . $this->date1 . "\n" . "\n"
                . '【第2希望日】' . "\n" . $this->date2 . "\n" . "\n"
                . '【第3希望日】' . "\n" . $this->date3 . "\n" . "\n"
                . '【備考欄】' . "\n" . $this->message . "\n" . "\n"
                . 'https://docs.google.com/spreadsheets/d/1rksm7upLpa96USboGyykITRzKo0ULXzpyGGcKtxUX3w/edit#gid=0');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
    }
}

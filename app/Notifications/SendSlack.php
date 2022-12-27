<?php

namespace App\Notifications;

use App\Models\Chat;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SendSlack extends Notification
{
    use Queueable;
    protected $user_name;
    protected $title;
    protected $message;
    protected $created_at;
    protected $channel;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_name, $title, $message, $created_at)
    {
        $this->user_name = $user_name;
        $this->title = $title;
        $this->message = $message;
        $this->created_at = $created_at;
        //
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
            ->content('お問い合わせが届きました。詳細をご確認ください。' . "\n"
                . '【タイトル】' . "\n" . $this->title . "\n"
                . '【名前】' . "\n" . $this->user_name  . "\n"
                . '【問い合わせ内容】' . "\n" . $this->message . "\n"
                . '【送信日時】' . "\n" . $this->created_at . "\n". "\n"
                . 'https://docs.google.com/spreadsheets/d/1zLOp_iBTlUKVfARAWErEwk33yNhnfs6xXSPjd9uWU9w/edit?hl=JA#gid=0');
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

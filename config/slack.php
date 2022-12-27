<?php

return [
    // Webhook URL
    'url' => env('SLACK_URL'),


    // デフォルトで使うチャンネル
    'channel' => env('SLACK_CHANNEL'),

    // 表示するユーザー名
    'username' => 'Slack-Test-From-Laravel',
];

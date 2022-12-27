<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Models\Customer;
use TCG\Voyager\Widgets\BaseDimmer;

class CustomerDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Customer::get()->count();
        $string = 'カスタマー';
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-bag',
            'title'  => "{$count} {$string}",
            'text'   => "データベースに{$count}人存在します。すべてのカスタマーを表示するには下記のボタンをクリックください。",
            'button' => [
                'text' => "すべての{$string}を表示",
                'link' => route('voyager.customers.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }
}

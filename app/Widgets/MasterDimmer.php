<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Models\Master;
use TCG\Voyager\Widgets\BaseDimmer;

class MasterDimmer extends BaseDimmer
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
        $count = Master::get()->count();
        $string = 'マスター';
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => "データベースに{$count}人存在します。すべての管理者を表示するには下記のボタンをクリックください。",
            'button' => [
                'text' => "すべての管理者を表示",
                'link' => route('voyager.masters.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }
}

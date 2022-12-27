<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_name', 'message','created_at'];

    public function scopeGetData($query)
    {
        return $this->title . '　@' . $this->user_name . '　' . $this->message .' '.$this->created_at;
    }


    // スプレッドシート挿入用Function
    static function insert_spread_sheet($insert_data)
    {
        // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
        $sheets = Contact::instance();

        // データを格納したい SpreadSheet のURLが
        // https://docs.google.com/spreadsheets/d/×××××××××××××××××××/edit#gid=0
        // である場合、××××××××××××××××××× の部分を以下に記入する
        $sheet_id = '1zLOp_iBTlUKVfARAWErEwk33yNhnfs6xXSPjd9uWU9w';
        $range = 'A1:A';
        $response = $sheets->spreadsheets_values->get($sheet_id, $range);
        // 格納する行の計算
        $row = count($response->getValues()) + 1;

        // データを整形（この順序でシートに格納される）
        $contact = [
            $insert_data['title'],
            $insert_data['user_name'],
            $insert_data['message'],
            $insert_data['created_at'],
        ];
        $values = new \Google_Service_Sheets_ValueRange();
        $values->setValues([
            'values' => $contact
        ]);
        $sheets->spreadsheets_values->append(
            $sheet_id,
            'A' . $row,
            $values,
            ["valueInputOption" => 'USER_ENTERED']
        );

        return true;
    }

    // スプレッドシート操作用のインスタンスを生成するFunction
    public static function instance()
    {
        // storage/app/json フォルダに GCP からダウンロードした JSON ファイルを設置する
        $credentials_path = storage_path('app/json/credentials.json');
        $client = new \Google_Client();
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentials_path);
        return new \Google_Service_Sheets($client);
    }
}

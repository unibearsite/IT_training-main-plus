<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// 操作するための Google_Service_Sheets インスタンスを生成する
// 格納されたデータを上書きしてしまわないように、挿入する行数を計算する
// 格納するデータの配列を整形する
// 指定されたスプレッドシートの指定された行数に指定されたデータを格納する
class SpreadSheet extends Model
{
    use HasFactory;

    // スプレッドシート挿入用Function
    static function insert_spread_sheet($insert_data)
    {
        // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
        $sheets = SpreadSheet::instance();

        // データを格納したい SpreadSheet のURLが
        // https://docs.google.com/spreadsheets/d/×××××××××××××××××××/edit#gid=0
        // である場合、××××××××××××××××××× の部分を以下に記入する
        $contact_sheet_id = '1zLOp_iBTlUKVfARAWErEwk33yNhnfs6xXSPjd9uWU9w';
        $range = 'A1:A';
        $response = $sheets->spreadsheets_values->get($contact_sheet_id, $range);
        // 格納する行の計算
        $row = count($response->getValues()) + 1;

        // データを整形（この順序でシートに格納される）
        $contact = [
            $insert_data['title'],
            $insert_data['user_name'],
            $insert_data['message'],
        ];
        $values = new \Google_Service_Sheets_ValueRange();
        $values->setValues([
            'values' => $contact
        ]);
        $sheets->spreadsheets_values->append(
            $contact_sheet_id,
            'A' . $row,
            $values,
            ["valueInputOption" => 'USER_ENTERED']
        );

        return true;
    }


    // メンタリング予約用
    static function meeting_spread_sheet($insert_data)
    {
        // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
        $sheets = SpreadSheet::instance();

        // データを格納したい SpreadSheet のURLが
        // https://docs.google.com/spreadsheets/d/×××××××××××××××××××/edit#gid=0
        // である場合、××××××××××××××××××× の部分を以下に記入する

        $meeting_sheet_id = '1rksm7upLpa96USboGyykITRzKo0ULXzpyGGcKtxUX3w';
        $range = 'A1:A';
        $response = $sheets->spreadsheets_values->get($meeting_sheet_id, $range);
        // 格納する行の計算
        $row = count($response->getValues()) + 1;

        // データを整形（この順序でシートに格納される）
        $meeting = [
            $insert_data['user_name'],
            $insert_data['perpose'],
            $insert_data['date1'],
            $insert_data['date2'],
            $insert_data['date3'],
            $insert_data['message'],
            $insert_data['created_at'],
        ];
        $values = new \Google_Service_Sheets_ValueRange();
        $values->setValues([
            'values' => $meeting
        ]);
        $sheets->spreadsheets_values->append(
            $meeting_sheet_id,
            'A' . $row,
            $values,
            ["valueInputOption" => 'USER_ENTERED']
        );

        return true;
    }



    // 週次報告用
    // static function report_spread_sheet($insert_data)
    // {
    //     // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
    //     $sheets = SpreadSheet::instance();

    //     $report_sheet_id = '1nCuFPGi_LHV530TgdJvNizx7x35JKOQphW75gYOFnxI';
    //     $range = 'A1:A';
    //     $response = $sheets->spreadsheets_values->get($report_sheet_id, $range);
    //     // 格納する行の計算
    //     $row = count($response->getValues()) + 1;

    //     // データを整形（この順序でシートに格納される）
    //     $report = [
    //         $insert_data['created_at'],
    //         $insert_data['user_name'],
    //         $insert_data['course_name'],
    //         $insert_data['now_lesson'],
    //         $insert_data['time'],
    //         $insert_data['learn'],
    //         $insert_data['trouble'],
    //         $insert_data['comment'],
    //     ];
    //     $values = new \Google_Service_Sheets_ValueRange();
    //     $values->setValues([
    //         'values' => $report
    //     ]);
    //     $sheets->spreadsheets_values->append(
    //         $report_sheet_id,
    //         'A' . $row,
    //         $values,
    //         ["valueInputOption" => 'USER_ENTERED']
    //     );

    //     return true;
    // }


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

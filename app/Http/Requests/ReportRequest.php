<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate = [];

        $validate += [
            'user_name' => [
                'required',
            ],
            'course_name' => [
                'required',
            ],
            'now_lesson' => [
                'required',
            ],
            'time' => [
                'required',
            ],
            'learn' => [
                'required',
            ],
            'trouble' => [
                'required',
            ],
        ];

        return $validate;
    }
}

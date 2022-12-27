<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
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
            'perpose' => [
                'required',
            ],
            'date1' => [
                'required',
                ],
            'date2' => [
                'required',
                ],
            'date3' => [
                'required',
                ],
        ];

        return $validate;
    }
}

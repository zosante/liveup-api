<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGroupUserRequest extends FormRequest
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
        return [
            'user_id' => [
                'required',
                'int',
                'not_in:' . $this->user()->id,
                'exists:users,id'
            ]
        ];
    }

    public function messages()
    {
        return [
          'user_id.not_in' => 'You cannot re-add yourself to the group'
        ];
    }
}

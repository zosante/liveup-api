<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/12/2020
 * Time: 4:02 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AddGroupRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:255',
                'unique:groups,user_id'
            ],
            'description' => [
                'required',
                'min:2'
            ]
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'title'=> 'required',
            'post_text'=> 'required',
            'category_id'=> 'required',
            'user_id'=>'required',
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'
            ,'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000']
        ];
    }
}

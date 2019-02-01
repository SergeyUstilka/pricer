<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PUT':
                $rules = [
                    'name'=> 'required|unique:product,slug,:slug\'',
                    'price'=>'required|numeric|max:100000',
                    'cat_id'=>'required',
                    'shop_id'=>'required',
                    'description'=>'min:10',

                ];
                break;

            default:
                $rules = [
                    'name'=> 'required|unique:product',
                    'price'=>'required|numeric|max:100000',
                    'cat_id'=>'required',
                    'shop_id'=>'required',
                    'description'=>'min:10',
                ];
                break;
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'name.required'=>'Поле Имя должно быть заполнено',
            'name.unique'=>'Товар с таким именем уже существует',
            'price.required'=>'Поле Цена должно быть заполнено',
            'price.numeric'=>'В поле цена должны быть только цифры',
            'description.min'=>'Описание товара короче 10 символов',
        ];
    }
}

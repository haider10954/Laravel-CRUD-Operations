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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name' => ['required'],
            'slug'=>['nullable','unique:products,slug'.(isset($this->product) ? ',id,'.$this->product->id : '')],
            'category' => ['required', 'exists:categories,id'],
            'thumbnail' =>  [isset($this->product) ? 'nullable' : 'required','mimes:jpg,png'],
            'image.*' =>  [isset($this->product) ? 'nullable' : 'required','mimes:jpg,png'],
            'description' => ['required'],
            'prize' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:1,0']

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => str()->slug($this->product_name)
        ]);
    }
}

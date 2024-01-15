<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en'=>['required','max:255', 'min:2', 'string'],
            'name_ar'=>['required','max:255', 'min:2', 'string'],
            'price'=>['required', 'numeric','min:1', 'max:99999999.99'],
            'quantity'=>['nullable','integer','min:1','max:99999'],
            'status'=>['nullable','integer','min:0','max:1'],
            'details_en'=> ['nullable','string'],
            'details_ar'=> ['nullable','string'],
            'brand_id'=>['nullable','integer','exists:brands,id'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            // 'photo'=>['required','size:10000','mimes:jpg,png']  // size, max  
            'photo'=>['required','max:10000','mimes:jpg,png']
        ];
    }
}

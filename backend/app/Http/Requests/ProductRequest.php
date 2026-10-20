<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->product;
        /**
         ** sometimes : If the field is present, validate it. If omitted, skip validation.
         * !== nullable Allow the field's value to be null without failing the other validation rules.
         */

        return [
            'category' => ['required','string', Rule::exists(Category::class, 'slug')],
            'title' => ['required','string','min:3','max:255',Rule::unique(Product::class)->ignore($product)],
            'purchase_price' => ['required','numeric','min:0','max:10000'],
            'selling_price' => ['required','numeric','min:' . $this->input('purchase_price',0), 'max:10000'],
            'stock' => ['sometimes','integer','min:0', 'max:100000'],
            'alert_ceil' => ['sometimes','integer','min:1','max:1000'],
            'active' => ['sometimes','boolean'],
            'image' => ['nullable','image','mimes:png,jpg,jpeg,webp'.'max:10000']
        ];
    }
}

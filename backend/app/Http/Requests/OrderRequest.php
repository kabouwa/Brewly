<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    private array $statues = ['PENDING','PREPARING','READY','COMPLETED','CANCELED'];
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
        return [
            'status' => ['nullable','string',Rule::in($this->statues)],
            'note' => ['nullable','string'],
            'items' => ['required','array','min:1'],
            'items.*' => ['required','array'],
            'items.*.product_reference' => ['required','string',Rule::exists(Product::class, 'reference')],
            'items.*.quantity' => ['required','integer','min:0'],
        ];
    }
}

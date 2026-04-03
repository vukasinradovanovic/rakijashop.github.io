<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $positionRule = ($this->user()?->hasRole('admin') ?? false)
            ? ['sometimes', 'nullable', 'integer', 'exists:product_positions,id']
            : ['prohibited'];

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'status_id' => ['sometimes', 'nullable', 'integer', 'exists:product_statuses,id'],
            'position_id' => $positionRule,
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'category_id' => ['sometimes', 'nullable', 'integer', 'exists:category_products,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class ProductIndexRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->has('in_stock')) {
            $this->merge([
                'in_stock' => $this->boolean('in_stock'),
            ]);
        }
    }
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Некорректные параметры запроса.',
            'errors' => $validator->errors(),
        ], 422));
    }
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['sometimes', 'string', 'max:255'],
            'price_from' => ['sometimes', 'numeric', 'min:0'],
            'price_to' => ['sometimes', 'numeric', 'min:0'],
            'category_id' => ['sometimes', 'integer', 'min:1'],
            'in_stock' => ['sometimes', 'boolean'],
            'rating_from' => ['sometimes', 'numeric', 'min:0'],
            'sort' => ['sometimes', Rule::in(['price_asc', 'price_desc', 'rating_desc', 'newest'])],
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }
}

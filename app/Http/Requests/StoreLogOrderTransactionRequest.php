<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogOrderTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'list' => ['required', 'array'],
            'list.*.purchased_quantity' => ['required', 'numeric'],
            'list.*.availed_price' => ['required', 'numeric'],
            'list.*.total_price' => ['required', 'numeric'],
        ];
    }
}

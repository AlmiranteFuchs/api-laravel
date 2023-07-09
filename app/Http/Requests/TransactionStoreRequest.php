<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'description' => 'required|string'
        ];
    }

   /*  public function validated($key = null, $default = null)
    {
        $validated = parent::validated();
        $validated['start_date'] = date('Y-m-d H:i:s', strtotime($validated['start_date']));
        $validated['end_date'] = date('Y-m-d H:i:s', strtotime($validated['end_date']));

        return $validated;
    } */

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUangSakuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'jumlah' => str_replace('.', '', $this->jumlah),
        ]);
    }

    public function rules(): array
    {
        return [
            'jumlah' => [
                'required',
                'numeric',
                'min:2',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests;

use App\Rules\WordsRegisterRule;
use Illuminate\Foundation\Http\FormRequest;

class WordsValidateRequest extends FormRequest
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
        return [
            'mean' => 'min:2',
        ];
    }
}

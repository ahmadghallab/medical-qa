<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreQuestionRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_id' => 'required|int',
            'question' => 'required',
            'answer' => 'required',
            'reference' => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'title_id' => 'Topic is required',
            'question' => 'Question is required',
            'answer' => 'Answer is required',
            'reference' => 'reference can not be empty',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->error(400, $validator->errors()->first())
        );
    }
}

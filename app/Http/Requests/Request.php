<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [];
    }

    /**
     * failedValidation
     *
     * @param  mixed $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'msg' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}

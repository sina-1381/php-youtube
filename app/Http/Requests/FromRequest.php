<?php


namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest as BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;


class FromRequest extends BaseFormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param array $append
     * @return array
     */
    public function filter($append = [])
    {
        return $this->only(array_merge(array_keys($this->rules()), $append));
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'captcha' => 'The captcha not valid'
        ];
    }
}

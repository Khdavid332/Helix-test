<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationCoordinatesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "location" => "required|string"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(["errors" => $validator->errors()], 400));
    }
}

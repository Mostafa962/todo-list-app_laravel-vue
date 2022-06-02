<?php

namespace App\Http\Requests;

use App\Http\Controllers\BaseResponse;
use Illuminate\{
    Contracts\Validation\Validator,
    Foundation\Http\FormRequest,
    Http\Exceptions\HttpResponseException,
};
/**
 * @OA\Schema(
 *     title="BaseRequest",
 *     description="Base Request",
 * )
 */
class BaseRequest extends FormRequest
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
     *  @param \Illuminate\Contracts\Validation\Validator
     *  @return \Illuminate\Http\Response
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new BaseResponse();
        throw new HttpResponseException($response->response(101, 'Validation Error',200, $validator->errors()->all()));
    }
}

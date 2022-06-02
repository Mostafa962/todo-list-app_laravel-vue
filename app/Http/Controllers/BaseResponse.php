<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * @OA\Schema(
 *     title="BaseResponse",
 *     description="Base Response",
 * )
 */
class BaseResponse extends Controller
{
    /**
     *
     * @OA\Property(
     *  property="code",
     *     description="Response Code",
     *     type="integer",
     * ),
     * @OA\Property(
     *  property="message",
     *     description="Operaion Message",
     *     type="string",
     * ),
     * @OA\Property(
     *  property="validations",
     *  description="validations rules",
     *     type="array",
     *          @OA\items(
     *          ref="#/components/schemas/BaseRequest"
     *              )
     * ),
     * @OA\Property(
     *  property="item",
     *     description="Record id if needed(like deleted record id)",
     *     type="integer",
     * ),
     * @OA\Property(
     *     property="data",
     *     type="object",
     * )
     *
     */
    public function response($code, $message, $statusCode, $validations = [], $item = 0, $object = null)
    {
        return response()->json(
            [
                'code'       => $code, 
                'message'    => $message, 
                'validation' => $validations,
                'item'       => $item, 
                'data'       => $object
            ], $statusCode);
    }
}

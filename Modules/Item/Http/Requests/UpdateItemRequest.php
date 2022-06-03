<?php

namespace Modules\Item\Http\Requests;
use App\Http\Requests\BaseRequest;
/**
 * @OA\Schema(
 *      title="UpdateItemRequest",
 *      description="Update Item request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateItemRequest extends BaseRequest
{

    /**
     * 
     * @OA\Property(
     *      property="is_completed",
     *      title="is completed attr",
     *      description="Status of the item",
     *      example="true"
     * ),
     */
    public function rules()
    {
        return [
            'is_completed'   => 'required|boolean',
        ];
    }

}

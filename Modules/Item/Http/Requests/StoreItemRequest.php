<?php

namespace Modules\Item\Http\Requests;
use App\Http\Requests\BaseRequest;
/**
 * @OA\Schema(
 *      title="StoreItemRequest",
 *      description="Store Item request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreItemRequest extends BaseRequest
{

    /**
     * 
     * @OA\Property(
     *      property="name",
     *      title="Item name",
     *      description="Name of the item",
     *      example="a nice item"
     * ),
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
        ];
    }

}

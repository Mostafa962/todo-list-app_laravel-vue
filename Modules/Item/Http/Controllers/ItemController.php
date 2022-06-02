<?php

namespace Modules\Item\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseResponse;
use Modules\Item\{
    Actions\StoreItemAction,
    Actions\UpdateItemAction,
    Actions\DeleteItemAction,
    Actions\RestoreItemAction,
    Actions\ForceDeleteItemAction,
    Http\Requests\StoreItemRequest,
    Http\Requests\UpdateItemRequest,
    Http\Resources\ItemCollection,
    Http\Resources\ItemResource,
    Entities\Item\Item,
};
class ItemController extends BaseResponse
{
    /**
     * @OA\Get(
     *      path="/items",
     *      operationId="getItemsList",
     *      tags={"items"},
     *      summary="Get list of items",
     *      description="Returns list of items",
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *     )
     */
    public function index()
    {
        try {
            $records = Item::orderBy('id','DESC')->paginate(10);
            return $this->response(200, 'Listing Items', 200, [], 0, [
                'items' => new ItemCollection($records),
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }

    }
    /**
     * @OA\Post(
     *      path="/items",
     *      operationId="itemsStore",
     *      tags={"items"},
     *      summary="Store new item",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreItemRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200 | Validation errors with code 101.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     * )
     */
    public function store(StoreItemRequest $request,  StoreItemAction $storeAction)
    {   
        try {
            $record = $storeAction->execute($request);
            return $this->response(200, 'Your item has been successfully created.', 200, [], 0, [
                'item' => new ItemResource($record),
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/items/{item}",
     *      operationId="itemShow",
     *      tags={"items"},
     *      summary="Show an item",
     *     @OA\Parameter(
     *          name="item",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200 | Validation errors with code 101. ",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *     )
     *
     */
    public function show($id)
    {
        try {
            $record = Item::find($id);
            if(!$record){
                return $this->response(101, 'Validation Errors', 200, ['Item is not found.']);
            }
            return $this->response(200, 'Show item details', 200, [], 0, [
                'item' => new ItemResource($record),
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }
    }

    /**
     * @OA\Put(
     *      path="/items/{item}",
     *      operationId="ItemUpdate",
     *      tags={"items"},
     *      summary="Update an item",
     *      @OA\Parameter(
     *          name="item",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateItemRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200 | Validation errors with code 101",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     * )
    */
    public function update(UpdateItemRequest $request, $id, UpdateItemAction $updateAction)
    {
        try {
            $record = Item::find($id);
            if(!$record){
                return $this->response(101, 'Validation Errors', 200, ['Item is not found.']);
            }
            $record = $updateAction->execute($request, $record);
            return $this->response(200, 'Your item has been successfully updated.', 200, [], 0, [
                'item' => new ItemResource($record),
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="/items/{item}",
     *      operationId="itemDelete",
     *      tags={"items"},
     *      summary="Delete existing item",
     *      @OA\Parameter(
     *          name="item",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200 | Validation errors with code 101",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     * )
    */

    public function destroy($id, DeleteItemAction $deleteAction)
    {
        try {
            $record = Item::find($id);
            if(!$record){
                return $this->response(101, 'Validation Errors', 200, ['Item is not found.']);
            }
            $recordId = $deleteAction->execute($record);
            return $this->response(200, 'Your item has been successfully deleted.', 200, [], $recordId);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }
    }
    /**
     * @OA\Post(
     *      path="/items/{item}/restore",
     *      operationId="itemRestore",
     *      tags={"items"},
     *      summary="Restore deleted item",
     *      @OA\Parameter(
     *          name="item",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200 | Validation errors with code 101",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     * )
    */

    public function restore($id, RestoreItemAction $restoreAction)
    {
        try {
            $record = Item::onlyTrashed()->find($id);
            if(!$record){
                return $this->response(101, 'Validation Errors', 200, ['Item is not found.']);
            }
            $recordId = $restoreAction->execute($record);
            return $this->response(200, 'Your item has been successfully restored .', 200, [], $recordId);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }
    }
    /**
     * @OA\Delete(
     *      path="/items/{item}/force/delete",
     *      operationId="itemForceDelete",
     *      tags={"items"},
     *      summary="Force delete deleted item",
     *      @OA\Parameter(
     *          name="item",
     *          description="Item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success operation with code 200 | Validation errors with code 101",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error.",
     *          @OA\JsonContent(ref="#/components/schemas/BaseResponse")
     *       ),
     * )
    */

    public function forceDelete($id, ForceDeleteItemAction $deleteAction)
    {
        try {
            $record = Item::onlyTrashed()->find($id);
            if(!$record){
                return $this->response(101, 'Validation Errors', 200, ['Item is not found.']);
            }
            $recordId = $deleteAction->execute($record);
            return $this->response(200, 'Your item has been successfully forever deleted :( .', 200, [], $recordId);
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->response(500, 'Failed, Please try again later.', 500);
        }
    }
}

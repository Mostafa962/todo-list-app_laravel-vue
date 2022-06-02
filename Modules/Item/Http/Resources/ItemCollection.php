<?php

namespace Modules\Item\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
/**
 * @OA\Schema(
 *     title="ItemCollection",
 *     description="Item collection",
 * )
 */
class ItemCollection extends ResourceCollection
{

    /**
     *
     * @OA\Property(
     *  property="items",
     *     description="Item Collection",
     *     type="array",
     *          @OA\Items(
     *          ref="#/components/schemas/ItemResource"
     *              )
     * ),
     * @OA\Property(
     *     property="pagination",
     *     type="object",
     *     @OA\Property(property="total", type="integer", ),
     *     @OA\Property(property="count", type="integer", ),
     *     @OA\Property(property="per_page", type="integer", ),
     *     @OA\Property(property="current_page", type="integer", ),
     *     @OA\Property(property="total_page", type="integer", ),
     * )
     *
     */
    public function toArray($request)
    {
        return [
            'data' => ItemResource::collection($this->collection),
            'pagination' => [
                'total'         => $this->total(),
                'count'         => $this->count(),
                'per_page'      => $this->perPage(),
                'current_page'  => $this->currentPage(),
                'total_pages'   => $this->lastPage()
            ],

        ];
    }
}

<?php

namespace Modules\Item\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     title="ItemResource",
 *     description="Item resource",
 * )
 */
class ItemResource extends JsonResource
{
    /**
     * @OA\Property(property="id", type="integer", ),
     * @OA\Property(property="name", type="string", ),
     * @OA\Property(property="isCompleted", type="boolean", ),
     * @OA\Property(property="completedAt", type="string" ),
     * @OA\Property(property="createdAt", type="string" ),
     * )
     *
     */
    public function toArray($request)
    {
        return [
            'id'            => (int)$this->id,
            'name'          => $this->name,
            'isCompleted'   => $this->isCompleted($this->is_completed),
            'completedAt'   => $this->convertDate($this->completed_at),
            'createdAt'     => $this->convertDate($this->created_at),

        ];
    }
}

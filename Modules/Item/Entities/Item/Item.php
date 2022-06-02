<?php

namespace Modules\Item\Entities\Item;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     title="Item",
 *     description="Item model",
 *     @OA\Xml(
 *         name="Item"
 *     )
 * )
 */
class Item extends Model
{
    use HasFactory, SoftDeletes, ScopesTrait, MethodTrait, 
        RelationsTrait, MutatorTrait, AccessorTrait;

    
     /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new item",
     *      example="A nice item",
     *      type="string"
     * 
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="is completed",
     *     description="Check if the item is completed, false for not completed, true for completed",
     *     example="true",
     *     type="boolean"
     * )
     *
     * @var boolean
     */
    private $is_completed;

    /**
     * @OA\Property(
     *     title="Completed at",
     *     description="Completed at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $completed_at;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * Build model factory.
     *
     * @return \Modules\Item\Database\factories\ItemFactory
     */
    protected static function newFactory()
    {
        return \Modules\Item\Database\factories\ItemFactory::new();
    }
}

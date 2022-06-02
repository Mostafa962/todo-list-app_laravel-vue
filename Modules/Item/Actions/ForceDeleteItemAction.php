<?php
namespace Modules\Item\Actions;
use Illuminate\Support\Facades\DB;
class ForceDeleteItemAction
{
    public function execute($item)
    {
        $record = DB::transaction(function () use ($item) {
            $id = $item->id;
            $item->forceDelete();
            return $id;
        });

        return $record;
    }
}

<?php
namespace Modules\Item\Actions;
use Illuminate\Support\Facades\DB;
class RestoreItemAction
{
    public function execute($item)
    {
        $record = DB::transaction(function () use ($item) {
            $id = $item->id;
            $item->restore();
            return $id;
        });

        return $record;
    }
}

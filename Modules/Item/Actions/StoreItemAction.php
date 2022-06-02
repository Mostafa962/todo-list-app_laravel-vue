<?php
namespace Modules\Item\Actions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Item\{
    Entities\Item\Item
};
class StoreItemAction
{
    public function execute(Request $request)
    {
        $record = DB::transaction(function () use ($request) {
            $input = $request->all();
            $record = Item::create($input);
            return $record;
        });

        return $record;
    }
}

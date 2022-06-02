<?php
namespace Modules\Item\Actions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UpdateItemAction
{
    public function execute(Request $request, $item)
    {
        $record = DB::transaction(function () use ($request, $item) {
            $input = $request->all();            
            $item->update($input);
            return $item;
        });

        return $record;
    }
}

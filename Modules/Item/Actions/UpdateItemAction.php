<?php
namespace Modules\Item\Actions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
class UpdateItemAction
{
    public function execute(Request $request, $item)
    {
        $record = DB::transaction(function () use ($request, $item) {
            $input = $request->all();    
            $input['completed_at'] = Carbon::now();        
            $item->update($input);
            return $item;
        });

        return $record;
    }
}

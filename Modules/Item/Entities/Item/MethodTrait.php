<?php

namespace Modules\Item\Entities\Item;

trait MethodTrait {

    /**
     * Convert timestamp to date and time.
     *
     * @param  Timestamp $timestamp
     * @return string
     */
    public function convertDate($timestamp)
    {
        return  date('d M Y', strtotime($timestamp)) ." - ". date('h:i a', strtotime($timestamp));
    }
}

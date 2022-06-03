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
        if(!$timestamp)
            return null;
        return  date('d M Y', strtotime($timestamp)) ." - ". date('h:i a', strtotime($timestamp));
    }

    /**
     * Check if the item is completed or not.
     *
     * @return boolean
     */
    public function isCompleted($isCompleted)
    {
        return $isCompleted ? true : false;
    }
}

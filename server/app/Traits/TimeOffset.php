<?php

namespace App\Traits;
use Carbon\Carbon;


trait TimeOffset
{

    public function getCreatedAtAttribute($value)
    {
        $mins = 0;
        return (new Carbon($value))->addMinutes($mins*60);
    } 
    public function getUpdatedAtAttribute($value)
    {
        $mins = 0;
        return (new Carbon($value))->addMinutes($mins*60);
    }
    public function getCreatedAtHumansAttribute()
    {
        $times =  $this->created_at->diffForHumans();
        return str_replace(['hours', 'minutes'], ['h', 'mins'],$times);
    }
    public function getUpdatedAtHumansAttribute()
    {

        $times = $this->updated_at->diffForHumans();
        return str_replace(['hours', 'minutes'], ['h', 'mins'],$times);
    }

}

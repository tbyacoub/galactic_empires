<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{

    public function buildings()
    {
        return $this->morphedByMany('App\Building', 'describable');
    }
}

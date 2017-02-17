<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingPrototype extends Model
{

    public function type(){
        return $this->type;
    }

    public function name(){
        return $this->name;
    }

    public function img(){
        return $this->img_path;
    }
}

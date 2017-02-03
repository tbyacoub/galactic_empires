<?php

namespace App;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'display_name', 'description'
    ];


=======
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //
>>>>>>> master
}

<?php

namespace App;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
      'name', 'display_name', 'description'
    ];
=======
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //
>>>>>>> master
}

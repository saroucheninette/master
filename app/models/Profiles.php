<?php
namespace App\Models;

class Profiles extends BaseModel {
    protected $table = 'Profiles';
    public $timestamps = false;
    protected $guarded = array('Profiles_id');
    protected $primaryKey = 'Profiles_id';
//    public $incrementing = true;
}

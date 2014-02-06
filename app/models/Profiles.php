<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Profiles extends Eloquent {
    protected $table = 'Profiles';
    public $timestamps = false;
    protected $guarded = array('Profiles_id');
//    public $incrementing = true;
}

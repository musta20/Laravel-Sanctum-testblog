<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = "post";
    protected $primaryKey  = "id";
    protected $fillable = ['id','title','context','uid'];
    public $timestamps = false;

 
}

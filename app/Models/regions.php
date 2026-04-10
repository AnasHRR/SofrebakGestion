<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regions extends Model
{
    protected $table = "regions";
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id' , 'nom' , 'description'];
}
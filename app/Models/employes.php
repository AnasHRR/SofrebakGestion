<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employes extends Model
{
    protected $table = "employes";
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = ["id","nom_complet","poste","telephone","email","region_id","date_embauche","salaire"];
}

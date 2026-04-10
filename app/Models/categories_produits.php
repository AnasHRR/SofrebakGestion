<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories_produits extends Model
{
    protected $table = "categories_produits";
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id' , 'nom' , 'description'];

    public function produits()
    {
        return $this->hasMany(Produits::class, 'categorie_id');
    }

}

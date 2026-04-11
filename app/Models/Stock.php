<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stock";
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id', 'produit_id', 'type_mouvement', 'quantite', 'date_mouvement', 'reference_id', 'notes'];

    public function produits(){
        return $this->belongsTo(Produits::class , 'produit_id' , 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $table = "produits";
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'nom_produit',
        'categorie_id',
        'fournisseur_id',
        'unite',
        'prix_achat',
        'prix_vente',
        'stock_minimum',
        'stock_actuel',
        'date_expiration'
    ];

    // Relation to fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(fournisseurs::class, 'fournisseur_id', 'id');
    }

    // Relation to category
    public function categorie()
    {
        return $this->belongsTo(categories_produits::class, 'categorie_id', 'id');
    }

    public function stock(){
        return $this->hasMany(Stock::class , 'produit_id' , 'id');
    }
}
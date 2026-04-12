<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsCommandesFournisseurs extends Model
{
    protected $table = 'details_commandes_fournisseurs';
    protected $fillable = ['id','commande_fournisseur_id','produit_id','quantite','prix_unitaire','prix_total'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    public function fournisseurs(){
        return $this->hasMany(commandesFournisseurs::class, 'id' , 'commande_fournisseur_id' );
    }
    public function produits(){
        return $this->hasMany(Produits::class , 'id' , 'produit_id');
    }
}

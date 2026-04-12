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

    public function commandeFournisseur(){
        return $this->belongsTo(commandesFournisseurs::class, 'commande_fournisseur_id', 'id');
    }

    public function produit(){
        return $this->belongsTo(Produits::class, 'produit_id', 'id');
    }
}

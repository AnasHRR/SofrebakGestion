<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsCommandeClients extends Model
{
    protected $table = 'details_commandes_clients';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','commande_client_id','produit_id','quantite','prix_unitaire','remise','prix_total'];

    public function commandeClient()
    {
        return $this->belongsTo(CommandeClient::class , 'commande_client_id' , 'id');
    }

    public function produit()
    {
        return $this->belongsTo(Produits::class ,'id');
    }
}
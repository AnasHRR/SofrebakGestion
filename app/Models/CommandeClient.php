<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeClient extends Model
{
    protected $table = "commandes_clients";
    protected $primaryKey = 'id';
    protected $fillable = ['id' , 'numero_commande' , 'date_commande' , 'client_id' , 'comptable_id' , 'date_livraison' , 'statut' , 'statut_paiement' , 'montant_total' , 'notes'];
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(clients::class, 'client_id' , 'id');
    }

    public function details()
    {
        return $this->hasMany(detailsCommandeClients::class, 'commande_client_id' , 'id');
    }

    public function comptable()
    {
        return $this->belongsTo(employes::class, 'comptable_id' , 'id');
    }

    public function factures()
    {
        return $this->hasMany(Factures::class, 'commande_client_id' , 'id');
    }
    public function expedition(){
        return $this->belongsTo(Expeditions::class, 'expedition_id' , 'id');
    }
}
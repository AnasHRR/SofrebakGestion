<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = ['id' , 'commande_client_id', 'numero_facture' , 'date_facture' , 'date_echeance' ,'date_reglement', 'sous_total' , 'montant_tva' , 'montant_total' , 'montant_paye' , 'statut'];
    protected $primaryKey = 'id';

    public function commande_client(){
        return $this->belongsTo(CommandeClient::class , 'commande_client_id' , 'id');
    }
    public function client(){
        return $this->belongsTo(clients::class , 'client_id' , 'id');
    }
}

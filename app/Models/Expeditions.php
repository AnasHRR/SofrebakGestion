<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expeditions extends Model
{
    protected $table = 'expeditions';
    protected $fillable = ['id' , 'commande_client_id', 'chauffeur_id','date_expedition' , 'numero_camion' , 'statut_livraison' , 'notes_livraison'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public function employes(){
        return $this->belongsTo(employes::class,'id');
    }

    public function commandesClient(){
        return $this->hasMany(CommandeClient::class , 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expeditions extends Model
{
    protected $table = 'expeditions';
    protected $fillable = ['id' , 'chauffeur_id','date_expedition' , 'numero_camion' , 'statut_livraison' , 'notes_livraison'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
    public function employes()
    {
        return $this->belongsTo(employes::class, 'chauffeur_id');
    }
    public function commandesClients()
    {
        return $this->hasMany(CommandeClient::class, 'expedition_id' , 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retours extends Model
{
    protected $table = 'retours';
    protected $primaryKey = 'id';
    protected $fillable = ['id' , 'commande_client_id' , 'produit_id' , 'quantite' , 'date_retour' , 'motif' , 'comptable_id' , 'region_id' , 'notes'];
    public $timestamps = false;
    public $incrementing = true;

    public function commande_client(){
        return $this->HasMany(CommandeClient::class, 'commande_client_id' , 'id');
    }

    public function produit(){
        return $this->hasMany(Produits::class,'produit_id','id');
    }

    public function employes(){
        return $this->belongsTo(Employes::class,'employes_id','id');
    }

    public function region(){
        return $this->belongsTo(regions::class,'region_id','id');
    }
}
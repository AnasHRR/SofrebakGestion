<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commandesFournisseurs extends Model
{
    protected $table = 'commandes_fournisseurs';
    protected $fillable = ['id' , 'date_commande' , 'fournisseurs_id' , 'employe_id' , 'statut' , 'montant_total' , 'notes'];
    protected $primarykey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function employe(){
        return $this->belongsTo(employes::class , 'employe_id' , 'id');
    }

    public function fournisseur(){
        return $this->belongsTo(fournisseurs::class , 'fournisseurs_id' , 'id');
    }
}
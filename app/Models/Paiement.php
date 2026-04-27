<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';
    protected $primaryKey = 'id';
    protected $fillable = ['id' , 'client_id' , "comptable_id", "montant", 'date_paiement' , 'mode_paiement', 'numero_cheque', 'region_id', 'notes', 'statut'];

    public $timestamps = false;
    public function client()
    {
        return $this->belongsTo(clients::class, 'client_id' , 'id');
    }

    public function comptable()
    {
        return $this->belongsTo(employes::class , 'comptable_id' , 'id');
    }

    public function region()
    {
        return $this->belongsTo(regions::class , 'region_id' , 'id');
    }
}

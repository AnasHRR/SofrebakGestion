<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';
    protected $primaryKey = 'id';
    protected $fillable = ['id' , 'client_id' , "comptable_id", "montant", 'date_paiement' , 'mode_paiement', 'region_id', 'notes'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function comptable()
    {
        return $this->belongsTo(employes::class);
    }

    public function region()
    {
        return $this->belongsTo(regions::class);
    }
}

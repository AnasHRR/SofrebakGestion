<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    protected $table = "clients";
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = ['id','nom_entreprise', 'personne_contact', 'telephone', 'email', 'adresse', 'region_id', 'plafond_credit'];

    public function region()
    {
        return $this->belongsTo(regions::class);
    }

    public function commandes()
    {
        return $this->hasMany(CommandeClient::class, 'client_id');
    }
}
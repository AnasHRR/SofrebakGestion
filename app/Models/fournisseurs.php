<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fournisseurs extends Model
{
    protected $table = "fournisseurs";
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id' , 'nom' , 'personne_contact' , 'telephone' , 'email' , 'adresse' , 'conditions_paiement'];
}
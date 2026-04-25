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

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'client_id');
    }

    public function factures()
    {
        return $this->hasMany(Factures::class, 'client_id');
    }

    public function retours()
    {
        return $this->hasManyThrough(Retours::class, CommandeClient::class, 'client_id', 'commande_client_id');
    }

    public function getTotalVentesAttribute()
    {
        return $this->commandes()->where('statut', '!=', 'Annulée')->sum('montant_total');
    }

    public function getTotalBrutAttribute()
    {
        // Somme des prix_total de tous les détails des commandes non annulées
        return CommandeClient::where('client_id', $this->id)
            ->where('statut', '!=', 'Annulée')
            ->join('details_commandes_clients', 'commandes_clients.id', '=', 'details_commandes_clients.commande_client_id')
            ->sum('details_commandes_clients.prix_total');
    }

    public function getTotalRetoursValeurAttribute()
    {
        return $this->retours()->whereHas('commande_client', function($query) {
            $query->where('statut', '!=', 'Annulée');
        })->get()->sum('valeur');
    }

    public function getTotalAchatsAttribute()
    {
        return $this->total_ventes - $this->total_retours_valeur;
    }

    public function getTotalPaiementsAttribute()
    {
        return $this->paiements()->sum('montant');
    }

    public function getCalculatedCreditAttribute()
    {
        return $this->total_ventes - $this->total_paiements;
    }
}
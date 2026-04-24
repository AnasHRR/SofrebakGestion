<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = ['id' , 'client_id', 'numero_facture' , 'date_facture' , 'date_echeance' ,'date_reglement', 'sous_total' , 'montant_tva' , 'montant_total' , 'montant_paye' , 'statut'];
    protected $primaryKey = 'id';

    protected $casts = [
        'sous_total' => 'float',
        'montant_tva' => 'float',
        'montant_total' => 'float',
        'montant_paye' => 'float',
        'date_facture' => 'date',
        'date_echeance' => 'date',
        'date_reglement' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($facture) {
            $total = (float)$facture->montant_total;
            $paye = (float)($facture->montant_paye ?? 0);

            // Cap montant_paye to montant_total
            if ($paye > $total) {
                $facture->montant_paye = $total;
                $paye = $total;
            }

            // Auto-update status based on amounts (unless it was manually set to Annulée)
            if ($facture->statut !== 'Annulée') {
                if ($paye <= 0) {
                    $facture->statut = 'Non payée';
                } elseif ($paye < $total) {
                    $facture->statut = 'Partiellement payée';
                } else {
                    $facture->statut = 'Payée';
                }
            }
        });
    }

    public function client(){
        return $this->belongsTo(clients::class , 'client_id' , 'id');
    }

    public function details()
    {
        return $this->hasMany(FactureDetail::class, 'facture_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FactureDetail extends Model
{
    protected $table = 'facture_details';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'facture_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'total'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function facture()
    {
        return $this->belongsTo(Factures::class, 'facture_id', 'id');
    }

    public function produit()
    {
        return $this->belongsTo(Produits::class, 'produit_id', 'id');
    }
}

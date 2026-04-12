<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $table = "produits";
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'nom_produit',
        'categorie_id',
        'fournisseur_id',
        'unite',
        'prix_achat',
        'prix_vente',
        'stock_minimum',
        'stock_initial',
        'date_expiration'
    ];

    /**
     * Append the computed stock_actuel attribute to the model.
     * This ensures $produit->stock_actuel works everywhere (Blade, JSON, etc.)
     */
    protected $appends = ['stock_actuel'];

    // Relation to fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(fournisseurs::class, 'fournisseur_id', 'id');
    }

    // Relation to category
    public function categorie()
    {
        return $this->belongsTo(categories_produits::class, 'categorie_id', 'id');
    }

    public function stock(){
        return $this->hasMany(Stock::class , 'produit_id' , 'id');
    }

    /**
     * Relation: all detail lines from client orders (sales) for this product.
     * Each detail line has a produit_id and quantite.
     */
    public function detailsCommandesClients()
    {
        return $this->hasMany(detailsCommandeClients::class, 'produit_id', 'id');
    }

    /**
     * Relation: all detail lines from supplier orders (purchases) for this product.
     * Each detail line has a produit_id and quantite.
     */
    public function detailsCommandesFournisseurs()
    {
        return $this->hasMany(detailsCommandesFournisseurs::class, 'produit_id', 'id');
    }

    /**
     * Accessor: compute stock dynamically.
     *
     * Formula: stock = stock_initial + total_purchases - total_sales
     *
     * This replaces the old static stock_actuel column.
     * Every time $produit->stock_actuel is accessed, it calculates
     * the real stock from actual transaction data.
     */
    public function getStockActuelAttribute()
    {
        $stockInitial   = $this->stock_initial ?? 0;
        $totalAchats    = $this->detailsCommandesFournisseurs()->sum('quantite');
        $totalVentes    = $this->detailsCommandesClients()->sum('quantite');

        return $stockInitial + $totalAchats - $totalVentes;
    }
}
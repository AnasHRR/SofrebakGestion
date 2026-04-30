<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $table = "produits";
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = ['id', 'nom_produit', 'categorie_id', 'fournisseur_id', 'img_pr', 'unite', 'prix_achat', 'prix_vente', 'stock_minimum', 'stock_initial', 'date_expiration'];

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

    public function retours()
    {
        return $this->hasMany(Retours::class, 'produit_id', 'id');
    }

    public function detailsCommandesClients()
    {
        return $this->hasMany(detailsCommandeClients::class, 'produit_id', 'id');
    }

    public function detailsCommandesFournisseurs()
    {
        return $this->hasMany(detailsCommandesFournisseurs::class, 'produit_id', 'id');
    }

    /**
     * Accessor: compute stock dynamically.
     *
     * Formula: stock = stock_initial
     *                 + total_purchases (commandes fournisseurs)
     *                 - total_sales (commandes clients)
     *                 + total_returns (retours clients)
     *                 + stock_entries (mouvements Entrée)
     *                 - stock_exits (mouvements Sortie)
     *
     * This replaces the old static stock_actuel column.
     * Every time $produit->stock_actuel is accessed, it calculates
     * the real stock from actual transaction data.
     */
    public function getStockActuelAttribute()
    {
        $stockInitial   = $this->stock_initial ?? 0;

        // From commandes
        $totalAchats    = $this->detailsCommandesFournisseurs()->sum('quantite');
        $totalVentes    = $this->detailsCommandesClients()->sum('quantite');
        $totalRetours   = $this->retours()->sum('quantite');

        // From stock movements (Entrée / Sortie)
        $totalEntrees   = $this->stock()->where('type_mouvement', 'Entrée')->sum('quantite');
        $totalSorties   = $this->stock()->where('type_mouvement', 'Sortie')->sum('quantite');

        return $stockInitial + $totalAchats - $totalVentes + $totalRetours + $totalEntrees - $totalSorties;
    }
}

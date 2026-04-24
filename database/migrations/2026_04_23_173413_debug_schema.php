<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $idType = Schema::getColumnType('factures', 'id');
        $prodIdType = Schema::getColumnType('produits', 'id');
        
        info("Factures ID type: " . $idType);
        info("Produits ID type: " . $prodIdType);
        
        // Also try to get more details via DB
        $factureIdCol = DB::select("SHOW COLUMNS FROM factures LIKE 'id'");
        $produitIdCol = DB::select("SHOW COLUMNS FROM produits LIKE 'id'");
        
        info("Factures ID col: " . json_encode($factureIdCol));
        info("Produits ID col: " . json_encode($produitIdCol));
    }

    public function down(): void {}
};

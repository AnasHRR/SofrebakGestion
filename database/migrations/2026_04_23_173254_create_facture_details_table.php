<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('facture_details');
        
        Schema::create('facture_details', function (Blueprint $blueprint) {
            $blueprint->string('id')->primary();
            $blueprint->string('facture_id');
            $blueprint->string('produit_id');
            $blueprint->integer('quantite');
            $blueprint->decimal('prix_unitaire', 15, 2);
            $blueprint->decimal('total', 15, 2);
            
            $blueprint->index('facture_id');
            $blueprint->index('produit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture_details');
    }
};

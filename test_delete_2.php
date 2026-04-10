<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $c = \App\Models\CommandeClient::first();
    if ($c) {
        try {
            $c->factures()->delete();
        } catch (\Exception $e) {
            echo "Error deleting factures: " . $e->getMessage() . "\n";
        }
        try {
            DB::table('expeditions')->where('commande_client_id', $c->id)->delete();
        } catch (\Exception $e) {
            echo "Error deleting expeditions: " . $e->getMessage() . "\n";
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
}

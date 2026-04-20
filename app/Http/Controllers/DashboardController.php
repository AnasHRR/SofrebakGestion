<?php

namespace App\Http\Controllers;

use App\Models\CommandeClient;
use App\Models\Factures;
use App\Models\clients;
use App\Models\Produits;
use App\Models\commandesFournisseurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCA = Factures::sum('montant_total') ?? 0;
        $totalCommandes = CommandeClient::count();
        $totalClients = clients::count();
        $totalProduits = Produits::count();
        $totalDepenses = commandesFournisseurs::sum('montant_total') ?? 0;
        $benefice = $totalCA - $totalDepenses;

        $recentCommandes = CommandeClient::with('client')
            ->orderBy('date_commande', 'desc')
            ->take(7)
            ->get();

        $maxBar = max($totalCA, $totalDepenses, 1);

        // Sales per month for the current year
        $salesPerMonth = CommandeClient::select(
            DB::raw('sum(montant_total) as total'),
            DB::raw("DATE_FORMAT(date_commande, '%m') as month")
        )
            ->whereYear('date_commande', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $monthlyData = [];
        $months = [
            '01' => 'Jan', '02' => 'Fév', '03' => 'Mar', '04' => 'Avr',
            '05' => 'Mai', '06' => 'Juin', '07' => 'Juil', '08' => 'Août',
            '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Déc'
        ];

        foreach ($months as $key => $name) {
            $monthlyData[] = [
                'month' => $name,
                'total' => $salesPerMonth->has($key) ? $salesPerMonth[$key]->total : 0
            ];
        }

        return view('daschboard.index', compact(
            'totalCA', 
            'totalCommandes', 
            'totalClients', 
            'totalProduits', 
            'totalDepenses', 
            'benefice', 
            'recentCommandes', 
            'maxBar',
            'monthlyData'
        ));
    }
}

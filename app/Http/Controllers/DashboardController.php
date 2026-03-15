<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalContacts = 0;
        $validContacts = 0;

        if (DB::getSchemaBuilder()->hasTable('contacts')) {
            $totalContacts = DB::table('contacts')->count();

            $validContacts = DB::table('contacts')
                ->where('validation_status', 'valid')
                ->count();
        }

        return view('dashboard', [
            'stats' => [
                'total_contacts' => $totalContacts,
                'valid_contacts' => $validContacts,
                'inconsistent_contacts' => 0,
                'quality_rate' => 0,
            ],
            'studies' => [
                'draft' => 0,
                'recruiting' => 0,
                'fieldwork' => 0,
                'completed' => 0,
            ],
            'alerts' => [],
            'recentImports' => [],
        ]);
    }
}

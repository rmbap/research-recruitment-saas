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
        $inconsistentContacts = 0;
        $qualityRate = 0;

        $studies = [
            'draft' => 0,
            'recruiting' => 0,
            'fieldwork' => 0,
            'completed' => 0,
        ];

        if (DB::getSchemaBuilder()->hasTable('contacts')) {
            $totalContacts = DB::table('contacts')->count();

            $validContacts = DB::table('contacts')
                ->where('validation_status', 'valid')
                ->count();
        }

        if (DB::getSchemaBuilder()->hasTable('import_rows')) {
            $inconsistentContacts = DB::table('import_rows')
                ->where('status', 'suspicious')
                ->count();
        }

        if ($totalContacts > 0) {
            $qualityRate = (int) round(($validContacts / $totalContacts) * 100);
        }

        if (DB::getSchemaBuilder()->hasTable('studies')) {
            $studies['draft'] = DB::table('studies')->where('status', 'draft')->count();
            $studies['recruiting'] = DB::table('studies')->where('status', 'recruiting')->count();
            $studies['fieldwork'] = DB::table('studies')->where('status', 'fieldwork')->count();
            $studies['completed'] = DB::table('studies')->where('status', 'completed')->count();
        }

        return view('dashboard', [
            'stats' => [
                'total_contacts' => $totalContacts,
                'valid_contacts' => $validContacts,
                'inconsistent_contacts' => $inconsistentContacts,
                'quality_rate' => $qualityRate,
            ],
            'studies' => $studies,
            'alerts' => [],
            'recentImports' => [],
        ]);
    }
}

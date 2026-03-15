<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'stats' => [
                'total_contacts' => 0,
                'valid_contacts' => 0,
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

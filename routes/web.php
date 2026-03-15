<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportUploadController;
use App\Livewire\Company\Setup;
use App\Livewire\Contacts\Index as ContactsIndex;
use App\Livewire\Imports\Index as ImportsIndex;
use App\Livewire\Imports\Show as ImportsShow;
use App\Livewire\Organizations\Index as OrganizationsIndex;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Company Setup
    |--------------------------------------------------------------------------
    */

    Route::get('company/setup', Setup::class)
        ->name('company.setup');

    /*
    |--------------------------------------------------------------------------
    | Organizations
    |--------------------------------------------------------------------------
    */

    Route::get('organizations', OrganizationsIndex::class)
        ->name('organizations.index');

    /*
    |--------------------------------------------------------------------------
    | Contacts
    |--------------------------------------------------------------------------
    */

    Route::get('contacts', ContactsIndex::class)
        ->name('contacts.index');

    /*
    |--------------------------------------------------------------------------
    | Imports
    |--------------------------------------------------------------------------
    */

    Route::get('imports', ImportsIndex::class)
        ->name('imports.index');

    Route::get('imports/{id}', ImportsShow::class)
        ->name('imports.show');

    Route::post('imports/upload', [ImportUploadController::class, 'store'])
        ->name('imports.upload');

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(
                        Features::twoFactorAuthentication(),
                        'confirmPassword'
                    ),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

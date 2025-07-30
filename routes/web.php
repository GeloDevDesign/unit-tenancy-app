<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\GeneralSetting;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    if (authUser()) {
        if (authUser()->isAdmin()) {
            // return redirect()->route('admin.index');
            return to_route('admin.index');
        }

        if (authUser()->isRegularAdmin()) {

            return to_route('admin.index');
        }


        if (authUser()->isTenant()) {

            return to_route('tenant.index');
        }

        if (authUser()->isTenantManager()) {

            return to_route('tenant-manager.index');
        }


        if (authUser()->isPropertyManager()) {

            return to_route('property.index');
        }

        if (authUser()->isOwner()) {

            return to_route('owner.index');
        }

        if (authUser()->isAccountant()) {

            return to_route('accountant.index');
        }
    }
})->middleware(['auth']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/tenant.php';
require __DIR__ . '/tenant-manager.php';
require __DIR__ . '/owner.php';
require __DIR__ . '/accountant.php';
require __DIR__ . '/property.php';

<?php

namespace App\Http\Controllers\Tenant;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class TenantController extends Controller
{
    //

    public function index()
    {

        $pageTitle = 'Admin - Dashboard';

        $generalSettings = GeneralSetting::find(1);
        $contents = optional($generalSettings)->dashboard_text ?? '';


        return view('tenant.index', compact('pageTitle', 'contents'));
    }

    public function store() {}
}

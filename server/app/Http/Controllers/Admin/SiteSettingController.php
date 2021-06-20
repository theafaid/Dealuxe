<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    public function index()
    {
        return view('site_settings.index');
    }
}

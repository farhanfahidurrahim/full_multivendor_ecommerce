<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function payment()
    {
        return view('backend.settings.payment');
    }
}

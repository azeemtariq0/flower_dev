<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('Frontend.pages.contact_us');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Principal;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index_view ()
    {
        return view('pages.principal.data', [
            'principal' => Principal::class
        ]);
    }
}

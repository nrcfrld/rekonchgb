<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index_view()
    {
        return view('pages.level.data', [
            'level' => Level::class
        ]);
    }
}

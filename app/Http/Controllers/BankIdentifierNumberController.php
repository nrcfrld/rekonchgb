<?php

namespace App\Http\Controllers;

use App\Models\BankIdentifierNumber;
use Illuminate\Http\Request;

class BankIdentifierNumberController extends Controller
{
    public function index_view()
    {
        return view('pages.bank-identifier-number.data', [
            'bankIdentifierNumber' => BankIdentifierNumber::class
        ]);
    }
}

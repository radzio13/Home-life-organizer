<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenditureController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function myExpenditureView(Request $request): View
    {
        return view('my-expenditure.index');
    }
}

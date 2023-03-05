<?php

namespace App\Http\Controllers;

use App\Models\ExpenditureCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DictionaryController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function dictionariesView(Request $request): View
    {
        return view('dictionaries.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getExpenditureCategoriesData(Request $request): JsonResponse
    {
        return response()->json([
            'categories' => ExpenditureCategory::all()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExpenditureCategory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeExpenditureCategory(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $name = $request->name;

            if (ExpenditureCategory::where('name', '=', $name)->exists()) {
                throw new \Exception('Taka kategoria wydatków już istnieje!');
            }

            $newExpenditureCategory = new ExpenditureCategory();
            $newExpenditureCategory->name = $name;
            $newExpenditureCategory->code = $name;
            $newExpenditureCategory->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pomyślnie dodano nową kategorię wydatków!',
        ]);
    }
}

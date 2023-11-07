<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DisciplineController extends Controller
{
    /**
     * Displays the view for disciplines page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('discipline.index');
    }

    /**
     * Retrieves details of a specific discipline.
     *
     * @param int $id Discipline ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function editDisciplines($id)
    {
        try {
            $discipline = Discipline::findOrFail($id);
            return response()->json(['status' => 200, 'discipline' => $discipline]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['status' => 404, 'message' => 'Discipline Not Found']);
        }
    }

    /**
     * Updates details of a specific discipline.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id Discipline ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDiscipline(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }

            $discipline = Discipline::findOrFail($id);
            $discipline->name = $request->input('name');
            $discipline->update();

            return response()->json(['status' => 200, 'message' => 'Discipline Updated Successfully']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['status' => 404, 'message' => 'Discipline Not Found']);
        }
    }

    /**
     * Deletes a specific discipline.
     *
     * @param int $id Discipline ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDiscipline($id)
    {
        try {
            $discipline = Discipline::findOrFail($id);
            $discipline->delete();
            return response()->json(['status' => 200, 'message' => 'Discipline Deleted Successfully']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['status' => 404, 'message' => 'Discipline Not Found']);
        }
    }

    /**
     * Fetches all disciplines.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchDisciplines()
    {
        try {
            $disciplines = DB::table('disciplines')->orderBy('id', 'desc')->get();
            return response()->json(['disciplines' => $disciplines]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['status' => 500, 'message' => 'Internal Server Error']);
        }
    }

    /**
     * Stores a new discipline.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }

            $discipline = new Discipline;
            $discipline->name = $request->input('name');
            $discipline->save();

            return response()->json(['status' => 200, 'message' => 'Discipline Added Successfully']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['status' => 500, 'message' => 'Internal Server Error']);
        }
    }
}

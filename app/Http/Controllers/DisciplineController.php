<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DisciplineController extends Controller
{
    public function index()
    {
        return view('discipline.index');
    }

    public function editDisciplines($id)
    {
        $discipline = Discipline::find($id);
        if($discipline) {
            return response()->json(['status' => 200, 'discipline' => $discipline]);
        }

        return response()->json(['status' => 404, 'message' => 'Discipline Not Found']);
    }

    public function updateDiscipline(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $discipline = Discipline::find($id);

        if($discipline) {

            $discipline->name = $request->input('name');
            $discipline->update();

            return response()->json(['status' => 200, 'message' => 'Discipline Updated Successfully']);

        } else {

            return response()->json(['status' => 404, 'message' => 'Discipline Not Found']);
        }

    }

    public function deleteDiscipline($id)
    {
        $discipline = Discipline::find($id);

        if($discipline) {

            $discipline->delete();

            return response()->json(['status' => 200, 'message' => 'Discipline Deleted Successfully']);

        } else {

            return response()->json(['status' => 404, 'message' => 'Discipline Not Found']);
        }
    }

    public function fetchDisciplines()
    {
        $disciplines = DB::table('disciplines')->orderBy('id', 'desc')->get();
        return response()->json(['disciplines' => $disciplines]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $discipline = new Discipline;
        $discipline->name = $request->input('name');
        $discipline->save();

        return response()->json(['status' => 200, 'message' => 'Discipline Added Successfully']);
    }

}

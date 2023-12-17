<?php

namespace App\Http\Controllers\Admin\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Hr\AwardType;
use Yajra\DataTables\DataTables;

class AwardTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('hr_award_type.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.hr.award_type.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = AwardType::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('description', function($model) {
                    return str_limit($model->notes, 20);
                })
                ->addColumn('action', function ($model) {
                    return view('admin.hr.award_type.action', compact('model'));
            })->rawColumns(['action', 'description'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('hr_award_type.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.hr.award_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('hr_award_type.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $model = new AwardType;
        $model->name = $request->name;
        $model->notes = $request->description;
        $model->save();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('hr_award_type.update')) {
            abort(403, 'Unauthorized action.');
        }

        $model = AwardType::findOrFail($id);
        return view('admin.hr.award_type.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('hr_award_type.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $model = AwardType::findOrFail($id);
        $model->name = $request->name;
        $model->notes = $request->description;
        $model->save();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('hr_award_type.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $model = AwardType::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

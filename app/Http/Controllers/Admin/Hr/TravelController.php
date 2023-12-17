<?php

namespace App\Http\Controllers\Admin\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\Hr\Travel;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('hr_travel.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.hr.travel.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Travel::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('employee', function($model) {
                    return $model->employee->name . ' (<b>'. employee_designation($model->employee_id) . '</b>)';
                })
                ->editColumn('time', function($model) {
                    return formatDate($model->start_date) . ' to '. formatDate($model->end_date);
                })
                ->editColumn('place', function($model) {
                    return $model->place_to_visit;
                })
                ->editColumn('budget', function($model) {
                    $output = '';
                    $currency = get_option('currency');
                    $output .= '<b>Expected Budget : </b>' . $currency . ' ' . number_format($model->expected_budge, 2);
                    $output .= '<br /><b>Actual Budget : </b>' . $currency . ' ' . number_format($model->actual_budget, 2);
                    return $output;
                })
                ->addColumn('action', function ($model) {
                    return view('admin.hr.travel.action', compact('model'));
            })->rawColumns(['action', 'time', 'employee', 'place', 'budget'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('hr_travel.create')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        return view('admin.hr.travel.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('hr_travel.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'employee_id' => 'required',
            'start_date' => 'required',
            'place_to_visit' => 'required',
            'expected_budget' => 'required',
        ]);

        $model = new Travel;
        $model->employee_id = $request->employee_id;
        $model->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $model->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $model->purpose_of_visit = $request->purpose_of_visit;
        $model->place_to_visit = $request->place_to_visit;
        $model->expected_budget = $request->expected_budget;
        $model->actual_budget = $request->actual_budget;
        $model->travel_media = $request->travel_media;
        $model->arrangement_type = $request->arrangement_type;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('hr_travel.view')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Travel::findOrFail($id);
        return view('admin.hr.travel.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('hr_travel.update')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        $model = Travel::findOrFail($id);
        return view('admin.hr.travel.edit', compact('model', 'employees'));
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
        if (!auth()->user()->can('hr_travel.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'employee_id' => 'required',
            'start_date' => 'required',
            'place_to_visit' => 'required',
            'expected_budget' => 'required',
        ]);

        $model = Travel::findOrFail($id);
        $model->employee_id = $request->employee_id;
        $model->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $model->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $model->purpose_of_visit = $request->purpose_of_visit;
        $model->place_to_visit = $request->place_to_visit;
        $model->expected_budget = $request->expected_budget;
        $model->actual_budget = $request->actual_budget;
        $model->travel_media = $request->travel_media;
        $model->arrangement_type = $request->arrangement_type;
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
        if (!auth()->user()->can('hr_travel.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Travel::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

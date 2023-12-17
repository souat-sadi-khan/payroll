<?php

namespace App\Http\Controllers\Admin\Hr;

use App\models\employee\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Department;
use App\models\employee\Employee;
use App\models\employee\EmployeeDesignation;
use App\models\employee\EmployeeTerm;
use App\models\Hr\EmployeeTranser;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('hr_transfer.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.hr.transfer.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = EmployeeTranser::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('employee', function($model) {
                    return $model->employee->name . ' (<b>'. employee_designation($model->employee_id) . '</b>)';
                })
                ->editColumn('past_dep', function($model) {
                    return $model->dept->name;
                })
                ->editColumn('new_dep', function($model) {
                    return current_dept($model->employee_id);
                })
                ->editColumn('date', function($model) {
                    return formatDate($model->date);
                })
                ->rawColumns(['past_dep', 'employee', 'new_dep', 'date'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('hr_transfer.create')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        $departments = Department::all();
        return view('admin.hr.transfer.create', compact('employees', 'departments'));
    }

    public function get_employee_designation(Request $request) {
        $id = $request->id;
        $designation_description = EmployeeDesignation::where('employee_id', $id)->latest()->first();
        if($designation_description) {
            $department_id = $designation_description->department_id;
            $find_department = Department::where('id', $department_id)->first();
            if($find_department) {
                $department = $find_department->name;
            } else {
                $department = '';
            }
        } else {
            $department = '';
        }
        $dep_id = $find_department->id;

        $data['name'] = $department;
        $data['id'] = $dep_id;

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('hr_transfer.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'employee_id' => 'required',
            'current_department' => 'required',
            'new_department' => 'required',
            'date' => 'required',
        ]);

        if($request->current_department == $request->new_department) {
            return response()->json(['success' => false, 'status' => 'danger', 'message' => _lang('Current Department and New Department is Same !')]);
        }

        // find the employee Designation 
        $emp_designation = EmployeeDesignation::findOrFail($request->employee_id);
        $employee_term_id = $emp_designation->employee_term_id;
        
        // find the employee term and add date_of_leaving
        $employee_term = EmployeeTerm::findOrFail($employee_term_id);
        $employee_term->date_of_leaving = Carbon::parse($request->date)->format('Y-m-d');
        $employee_term->save();

        $term_model = new EmployeeTerm;
        $term_model->employee_id = $request->employee_id;
        $term_model->date_of_joining = Carbon::parse($request->date)->format('Y-m-d');
        $term_model->save();
        $term_id = $term_model->id;

        $emp_designation_model = new EmployeeDesignation;
        $emp_designation_model->employee_id = $request->employee_id;
        $emp_designation_model->designation_id = $emp_designation->designation_id;
        $emp_designation_model->department_id = $request->new_department;
        $emp_designation_model->employee_term_id  = $term_id;
        $emp_designation_model->date_effective  = Carbon::parse($request->date)->format('Y-m-d');
        $emp_designation_model -> save();

        $model = new EmployeeTranser;
        $model->employee_id = $request->employee_id;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->department_from = $request->current_department;
        $model->department_to = $request->new_department;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created !')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('hr_transfer.update')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (!auth()->user()->can('hr_transfer.update')) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('hr_transfer.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $model = EmployeeTranser::findOrFail($id);
        $model->delete();

        
    }
}

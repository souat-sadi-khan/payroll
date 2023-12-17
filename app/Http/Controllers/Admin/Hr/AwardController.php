<?php

namespace App\Http\Controllers\Admin\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\Hr\Award;
use App\models\Hr\AwardType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('hr_award.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.hr.award.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Award::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('award_type', function($model) {
                    return $model->award->name;
                })
                ->editColumn('employee', function($model) {
                    return $model->employee->name . ' (<b>'. employee_designation($model->employee_id) . '</b>)';
                })
                ->editColumn('month', function($model) {
                    return $model->month . ' '. $model->year;
                })
                ->editColumn('gift', function($model) {
                    return $model->gift;
                })
                ->editColumn('cash', function($model) {
                    return $model->cash != '' ? get_option('currency') . ' ' . number_format($model->cash, 2) : '';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.hr.award.action', compact('model'));
            })->rawColumns(['action', 'award_type', 'employee', 'month', 'gift', 'cash'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('hr_award.create')) {
            abort(403, 'Unauthorized action.');
        }

        $award_types = AwardType::all();
        $employees = Employee::all();
        return view('admin.hr.award.create', compact('award_types', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('hr_award.create')) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'employee_id' => 'required',
            'award_type_id' => 'required',
            'date' => 'required',
            'month' => 'required',
            'photo' => 'mimes:png,jpg,jpeg|max:1024',
        ]);

        $month_explode = explode(', ', $request->month);
        $month_name = $month_explode[0];
        $year = $month_explode[1];

        $model = new Award;
        $model->employee_id = $request->employee_id;
        $model->award_type_id = $request->award_type_id;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->gift = $request->gift;
        $model->cash = $request->cash;
        $model->notes = $request->notes;
        $model->month = $month_name;
        $model->year = $year;
        $model->award_info = $request->award_info;

        if($request->hasFile('photo')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('photo')->store('public/hr/award/');
                $fileName = basename($storagepath);
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('hr/award', $request->file('banner'));

            }


            $model->photo = $fileName;

        }

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
        if (!auth()->user()->can('hr_award.view')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Award::findOrFail($id);
        return view('admin.hr.award.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('hr_award.update')) {
            abort(403, 'Unauthorized action.');
        }

        $award_types = AwardType::all();
        $employees = Employee::all();
        $model = Award::findOrFail($id);
        return view('admin.hr.award.edit', compact('award_types', 'employees', 'model'));
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
        if (!auth()->user()->can('hr_award.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'employee_id' => 'required',
            'award_type_id' => 'required',
            'date' => 'required',
            'month' => 'required',
            'photo' => 'mimes:png,jpg,jpeg|max:1024',
        ]);

        $month_explode = explode(', ', $request->month);
        $month_name = $month_explode[0];
        $year = $month_explode[1];

        $model = Award::findOrFail($id);
        $model->employee_id = $request->employee_id;
        $model->award_type_id = $request->award_type_id;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->gift = $request->gift;
        $model->cash = $request->cash;
        $model->notes = $request->notes;
        $model->month = $month_name;
        $model->year = $year;
        $model->award_info = $request->award_info;

        if($request->hasFile('photo')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('photo')->store('public/hr/award/');
                $fileName = basename($storagepath);

                // if file chnage then delete old one
                $oldFile = $model->photo;
                if( $oldFile != ''){

                    $file_path = "public/hr/award/".$oldFile;
                    Storage::delete($file_path);
                }
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('hr/award', $request->file('banner'));

                // if file chnage then delete old one
                $oldFile = $model->photo;
                if( $oldFile != ''){

                    $file_path = "uploads/".$oldFile;
                    Storage::delete($file_path);
                }
            }

            $model->photo = $fileName;

        }

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
        if (!auth()->user()->can('hr_award.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Award::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

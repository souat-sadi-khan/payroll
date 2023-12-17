<?php

namespace App\Http\Controllers\Admin\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\Hr\Resign;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ResignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('hr_resign.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.hr.resign.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('hr_resign.create')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        return view('admin.hr.resign.create', compact('employees'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Resign::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('employee', function($model) {
                    return $model->employee->name . ' (<b>'. employee_designation($model->employee_id) . '</b>)';
                })
                ->editColumn('notice_date', function($model) {
                    return formatDate($model->notice_date);
                })
                ->editColumn('resign_date', function($model) {
                    return formatDate($model->resign_date);
                })
                ->editColumn('approeve', function($model) {
                    return $model->approve_level == null ? '-' : $model->approve_level;
                })
                ->addColumn('action', function ($model) {
                    return view('admin.hr.resign.action', compact('model'));
            })->rawColumns(['action', 'notice_date', 'employee', 'resign_date', 'approeve'])->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('hr_resign.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'employee_id' => 'required',
            'notice_date' => 'required',
            'resign_date' => 'required',
            'reason' => 'required',
            // 'file' => 'mimes:docx, txt, pdf|max:1024',
        ]);

        $model = new Resign;
        $model->employee_id = $request->employee_id;
        $model->notice_date = Carbon::parse($request->notice_date)->format('Y-m-d');
        $model->resign_date = Carbon::parse($request->resign_date)->format('Y-m-d');
        $model->resign_reason = $request->reason;

        if($request->hasFile('file')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/hr/resign/');
                $fileName = basename($storagepath);
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('hr/resign', $request->file('banner'));

            }

            $model->file = $fileName;

        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('hr_resign.view')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Resign::findOrFail($id);
        return view('admin.hr.resign.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('hr_resign.update')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        $model = Resign::findOrFail($id);
        return view('admin.hr.resign.edit', compact('employees', 'model'));
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
        if (!auth()->user()->can('hr_resign.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'employee_id' => 'required',
            'notice_date' => 'required',
            'resign_date' => 'required',
            'reason' => 'required',
            // 'file' => 'mimes:docx, txt, pdf|max:1024',
        ]);

        $model = Resign::findOrFail($id);
        $model->employee_id = $request->employee_id;
        $model->notice_date = Carbon::parse($request->notice_date)->format('Y-m-d');
        $model->resign_date = Carbon::parse($request->resign_date)->format('Y-m-d');
        $model->resign_reason = $request->reason;
        $model->approve_level = $request->approve_level;

        if($request->hasFile('file')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/hr/resign/');
                $fileName = basename($storagepath);

                // if file chnage then delete old one
                $oldFile = $model->file;
                if( $oldFile != ''){

                    $file_path = "public/hr/resign/".$oldFile;
                    Storage::delete($file_path);
                }
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('hr/resign', $request->file('banner'));

                // if file chnage then delete old one
                $oldFile = $model->file;
                if( $oldFile != ''){

                    $file_path = "uploads/".$oldFile;
                    Storage::delete($file_path);
                }
            }

            $model->file = $fileName;

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
        if (!auth()->user()->can('hr_resign.delete')) {
            abort(403, 'Unauthorized action.');
        }
        $model = Resign::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

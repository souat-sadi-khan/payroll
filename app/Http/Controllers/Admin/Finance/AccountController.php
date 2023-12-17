<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Finance\Account;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.finance.account.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Account::where('account_name', '!=', config('system.default_role.admin'))->get();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('account_name', function($model) {
                    return str_limit($model->account_name, 60);
                })
                ->editColumn('balance', function($model) {
                    $currency = get_option('currency') != '' ? get_option('currency') : 'BDT';
                    $balance = number_format($model->balance, 2);
                    
                    return $currency . ' '. $balance;
                })
                ->editColumn('status', function($model) {
                    return $model->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.finance.account.action', compact('model'));
            })->rawColumns(['action', 'account_name', 'status', 'balance'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.finance.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'account_name' => 'required|min:3|max:50',
            'account_no' => 'required|min:3|max:50',
            'bank_name' => 'required|min:3|max:50',
            'branch_name' => 'required|min:3|max:50',
            'status' => 'required',
            'balance' => 'required|numeric',
        ]);

        $model = new Account;
        $model->account_name = $request->account_name;
        $model->account_no = $request->account_no;
        $model->bank_name = $request->bank_name;
        $model->branch_name = $request->branch_name;
        $model->status = $request->status;
        $model->balance = $request->balance;
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
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Account::findOrFail($id);
        return view('admin.finance.account.edit', compact('model'));
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
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'account_name' => 'required|min:3|max:50',
            'account_no' => 'required|min:3|max:50',
            'bank_name' => 'required|min:3|max:50',
            'branch_name' => 'required|min:3|max:50',
            'status' => 'required',
            'balance' => 'required|numeric',
        ]);

        $model = Account::findOrFail($id);
        $model->account_name = $request->account_name;
        $model->account_no = $request->account_no;
        $model->bank_name = $request->bank_name;
        $model->branch_name = $request->branch_name;
        $model->status = $request->status;
        $model->balance = $request->balance;
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
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Account::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

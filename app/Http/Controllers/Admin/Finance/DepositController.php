<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\Finance\Account;
use App\models\Finance\Deposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DepositController extends Controller
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

        return view('admin.finance.deposit.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Deposit::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('account_id', function($model) {
                    return $model->account->account_name;
                })
                ->editColumn('payees_id', function($model) {
                    return $model->employee->name;
                })
                ->editColumn('amount', function($model) {
                    $currency = get_option('currency') != '' ? get_option('currency') : 'BDT';
                    $balance = number_format($model->amount, 2);
                    
                    return $currency . ' '. $balance;
                })
                ->editColumn('date', function($model) {
                    return formatDate($model->date);
                })
                ->addColumn('action', function ($model) {
                    return view('admin.finance.deposit.action', compact('model'));
            })->rawColumns(['action', 'account_id', 'payees_id', 'amount', 'date'])->make(true);
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

        $accounts = Account::where('status', '1')->get();
        $employees = Employee::all();
        return view('admin.finance.deposit.create', compact('accounts', 'employees'));
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
            'account_id' => 'required',
            'payees_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'date' => 'required',
            'category' => 'required',
        ]);

        $model = new Deposit;
        $model->account_id = $request->account_id;
        $model->payees_id = $request->payees_id;
        $model->amount = $request->amount;
        $model->payment_method = $request->payment_method;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->category = $request->category;
        $model->ref_no = $request->ref_no;
        $model->notes = $request->notes;
        
        // checking the host
        if($request->hasFile('banner')) {
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/finance/deposit/');
                $fileName = basename($storagepath);

            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('finance/deposit', $request->file('file'));

            }

            $model->file = $fileName;
        }

        $model->save();

        // Add Deposit Balance To the Account
        $account = Account::findOrFail($request->account_id);
        $prev_balance = $account->balance;
        $new_balance = $request->amount;
        $updated_balance = $prev_balance + $new_balance;
        $account->balance = $updated_balance;
        $account->save();

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

        $model = Deposit::findOrFail($id);
        return view('admin.finance.deposit.show', compact('model'));
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

        $accounts = Account::where('status', '1')->get();
        $employees = Employee::all();
        $model = Deposit::findOrFail($id);
        return view('admin.finance.deposit.edit', compact('employees', 'accounts', 'model'));
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
            'account_id' => 'required',
            'payees_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'date' => 'required',
            'category' => 'required',
        ]);

        $model = Deposit::findOrFail($id);

        // check store account and update account is same or not
        if($model->account_id != $request->account_id) {
            $account = Account::findOrFail($model->account_id);
            $old_balance = $account->balance;
            $update_balance = $old_balance - $request->amount;
            $account->balance = $update_balance;
            $account->save();

            $account = Account::findOrFail($request->account_id);
            $old_balance = $account->balance;
            $update_balance = $old_balance + $request->amount;
            $account->balance = $update_balance;
            $account->save();

        }

        $model->account_id = $request->account_id;
        $model->payees_id = $request->payees_id;
        $model->amount = $request->amount;
        $model->payment_method = $request->payment_method;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->category = $request->category;
        $model->ref_no = $request->ref_no;
        $model->notes = $request->notes;
        
        // checking the host
        if($request->hasFile('banner')) {
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/finance/deposit/');
                $fileName = basename($storagepath);

            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('finance/deposit', $request->file('file'));

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
        if (!auth()->user()->can('workorder.update')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Deposit::findOrFail($id);
        $model->delete();

        // Add Deposit Balance To the Account
        $account = Account::findOrFail($model->account_id);
        $prev_balance = $account->balance;
        $new_balance = $model->amount;
        $updated_balance = $prev_balance - $new_balance;
        $account->balance = $updated_balance;
        $account->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

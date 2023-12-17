<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\Finance\Account;
use App\models\Finance\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('finance_expense.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.finance.expense.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Expense::all();

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
                    return view('admin.finance.expense.action', compact('model'));
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
        if (!auth()->user()->can('finance_expense.create')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        $accounts = Account::where('status', 1)->get();

        return view('admin.finance.expense.create', compact('employees', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('finance_expense.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'account_id' => 'required',
            'payees_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'date' => 'required',
            'photo' => 'mimes:pdf,docx,png,jpg,jpeg|max:1024',
        ]);

        $model = new Expense;
        $model->account_id = $request->account_id;
        $model->payers_id = $request->payees_id;
        $model->amount = $request->amount;
        $model->payment_method = $request->payment_method;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->ref_no = $request->ref_no;
        $model->notes = $request->notes;
        
        if($request->hasFile('file')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/finance/expense/');
                $fileName = basename($storagepath);
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('finance/expense', $request->file('file'));

            }


            $model->file = $fileName;

        }

        $model->save();

        // Add Deposit Balance To the Account
        $account = Account::findOrFail($request->account_id);
        $prev_balance = $account->balance;
        $new_balance = $request->amount;
        $updated_balance = $prev_balance - $new_balance;
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
        if (!auth()->user()->can('finance_expense.view')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Expense::findOrFail($id);
        return view('admin.finance.expense.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('finance_expense.update')) {
            abort(403, 'Unauthorized action.');
        }

        $employees = Employee::all();
        $accounts = Account::where('status', 1)->get();
        $model = Expense::findOrFail($id);
        
        return view('admin.finance.expense.edit', compact('employees', 'accounts', 'model'));
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
        if (!auth()->user()->can('finance_expense.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'account_id' => 'required',
            'payees_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'date' => 'required',
            'photo' => 'mimes:pdf,docx,png,jpg,jpeg|max:1024',
        ]);

        $model = Expense::findOrFail($id);

        // check store account and update account is same or not
        if($model->account_id != $request->account_id) {
            $account = Account::findOrFail($model->account_id);
            $old_balance = $account->balance;
            $update_balance = $old_balance + $request->amount;
            $account->balance = $update_balance;
            $account->save();

            $account = Account::findOrFail($request->account_id);
            $old_balance = $account->balance;
            $update_balance = $old_balance - $request->amount;
            $account->balance = $update_balance;
            $account->save();

        }

        $model->account_id = $request->account_id;
        $model->payers_id = $request->payees_id;
        $model->amount = $request->amount;
        $model->payment_method = $request->payment_method;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->ref_no = $request->ref_no;
        $model->notes = $request->notes;
        
        if($request->hasFile('file')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/finance/expense/');
                $fileName = basename($storagepath);

                // if file chnage then delete old one
                $oldFile = $model->file;
                if( $oldFile != ''){

                    $file_path = "public/finance/expense/".$oldFile;
                    Storage::delete($file_path);
                }
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('finance/expense', $request->file('file'));

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
        if (!auth()->user()->can('finance_expense.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Expense::findOrFail($id);
        $model->delete();

        // Add Deposit Balance To the Account
        $account = Account::findOrFail($model->account_id);
        $prev_balance = $account->balance;
        $new_balance = $model->amount;
        $updated_balance = $prev_balance + $new_balance;
        $account->balance = $updated_balance;
        $account->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

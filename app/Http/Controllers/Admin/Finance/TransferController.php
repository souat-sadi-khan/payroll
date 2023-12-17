<?php

namespace App\Http\Controllers\Admin\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Finance\Account;
use App\models\Finance\Transfer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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
        if (!auth()->user()->can('finance_transfer.view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.finance.transfer.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Transfer::all();

            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('from_account', function($model) {
                    return $model->from_account->account_name;
                })
                ->editColumn('to_account', function($model) {
                    return $model->to_account->account_name;
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
                    return view('admin.finance.transfer.action', compact('model'));
            })->rawColumns(['action', 'from_account', 'to_account', 'amount', 'date'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('finance_transfer.create')) {
            abort(403, 'Unauthorized action.');
        }

        $accounts = Account::where('status', 1)->get();
        return view('admin.finance.transfer.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('finance_transfer.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'from_account_id' => 'required',
            'to_account_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'photo' => 'mimes:pdf,docx,png,jpg,jpeg|max:1024'
        ]);

        $account = Account::findOrFail($request->from_account_id);
        $old_balance = $account->balance;
        $update_balance = $old_balance - $request->amount;
        $account->balance = $update_balance;
        $account->save();

        $account = Account::findOrFail($request->to_account_id);
        $old_balance = $account->balance;
        $update_balance = $old_balance + $request->amount;
        $account->balance = $update_balance;
        $account->save();

        $model = new Transfer;
        $model->from_account_id = $request->from_account_id;
        $model->to_account_id = $request->to_account_id;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->amount = $request->amount;
        $model->payment_method = $request->payment_method;
        $model->ref_no = $request->ref_no;
        $model->notes = $request->notes;

        if($request->hasFile('file')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/finance/transfer/');
                $fileName = basename($storagepath);
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('finance/transfer', $request->file('file'));
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
        if (!auth()->user()->can('finance_transfer.view')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Transfer::findOrFail($id);
        return view('admin.finance.transfer.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('finance_transfer.update')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Transfer::findOrFail($id);
        $accounts = Account::where('status', 1)->get();
        return view('admin.finance.expense.edit', compact('model', 'accounts'));
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
        if (!auth()->user()->can('finance_transfer.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'from_account_id' => 'required',
            'to_account_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'photo' => 'mimes:pdf,docx,png,jpg,jpeg|max:1024'
        ]);

        $model = Transfer::findOrFail($id);

        if($model->from_account_id != $request->from_account_id) {
            $account = Account::findOrFail($model->from_account_id);
            $old_balance = $account->balance;
            $update_balance = $old_balance + $request->amount;
            $account->balance = $update_balance;
            $account->save();
        }

        if($model->to_account_id != $request->to_account_id) {
            $account = Account::findOrFail($model->to_account_id);
            $old_balance = $account->balance;
            $update_balance = $old_balance - $request->amount;
            $account->balance = $update_balance;
            $account->save();
        }

        $account = Account::findOrFail($request->from_account_id);
        $old_balance = $account->balance;
        $update_balance = $old_balance - $request->amount;
        $account->balance = $update_balance;
        $account->save();

        $account = Account::findOrFail($request->to_account_id);
        $old_balance = $account->balance;
        $update_balance = $old_balance + $request->amount;
        $account->balance = $update_balance;
        $account->save();

        $model->from_account_id = $request->from_account_id;
        $model->to_account_id = $request->to_account_id;
        $model->date = Carbon::parse($request->date)->format('Y-m-d');
        $model->amount = $request->amount;
        $model->payment_method = $request->payment_method;
        $model->ref_no = $request->ref_no;
        $model->notes = $request->notes;

        if($request->hasFile('file')) {

            // checking the host
            $host = '';
            $host = get_option('host');

            if($host == 1) {
                
                // this is for vps hosting
                $storagepath = $request->file('file')->store('public/finance/transfer/');
                $fileName = basename($storagepath);

                // if file chnage then delete old one
                $oldFile = $model->file;
                if( $oldFile != ''){

                    $file_path = "public/finance/transfer/".$oldFile;
                    Storage::delete($file_path);
                }
    
            } else {
                
                // This is for Shared Hosting
                $fileName = Storage::disk('uploads')->put('finance/transfer', $request->file('file'));

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
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('finance_transfer.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $model = Transfer::findOrFail($id);
        $from_account = Account::findOrFail($model->from_account_id);
        $to_account = Account::findOrFail($model->to_account_id);
        $amount = $model->amount;

        // Add balance to from account
        $old_balance = $from_account->balance;
        $new_balance = $old_balance + $amount;
        $from_account->balance = $new_balance;
        $from_account->save();

        // Substract balance to To account
        $update_balance = $to_account->balance;
        $new_balance = $update_balance - $amount;
        $to_account->balance = $new_balance;
        $to_account->save();

        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}

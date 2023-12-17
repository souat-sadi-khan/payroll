<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\User;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UiController extends Controller
{
	// return to the user profile page
	public function index()
	{
		$id =Auth::user()->id;
		$user =User::findOrFail($id);
		return view('admin.user.profile',compact('user'));
	}

	// Edit user data
    public function postprofile(Request $request)
   	{
   	  	if ($request->ajax()) {
			$validator = Validator::make($request->all(),[
				'first_name' => ['sometimes', 'nullable','string'],
				'last_name' => ['sometimes', 'nullable','string'],
			]);
			$id =Auth::user()->id;
        	$model =User::findOrFail($id);
			$model->surname =$request->surname;
			$model->first_name =$request->first_name;
			$model->last_name =$request->last_name;
			$model->name =$request->name;
			$model->phone =$request->phone;
			$model->save();

			// cover image
			if($request->hasFile('image')) {
				$model = User::findOrFail(Auth::user()->id);

				// checking the host
				$host = '';
				$host = get_option('host');

				if($host == 1) {
					
					// this is for vps hosting
					$storagepath = $request->file('image')->store('public/user/photo/');
					$fileName = basename($storagepath);

				} else {
					
					// This is for Shared Hosting
					$fileName = Storage::disk('uploads')->put('user/photo', $request->file('image'));

				}
	
				$model->image = $fileName;
	
				//if file chnage then delete old one
				$oldFile = $request->oldFile;
				if( $oldFile != ''){

					$file_path = "public/user/photo/".$oldFile;
					Storage::delete($file_path);
				}
	
			}

			// Banner
			if($request->hasFile('banner')) {

				$model = User::findOrFail(Auth::user()->id);

				// checking the host
				$host = '';
				$host = get_option('host');

				if($host == 1) {
					
					// this is for vps hosting
					$storagepath = $request->file('banner')->store('public/user/banner/');
					$fileName = basename($storagepath);
		
				} else {
					
					// This is for Shared Hosting
					$fileName = Storage::disk('uploads')->put('user/banner', $request->file('banner'));

				}


				$model->banner = $fileName;
	
				//if file chnage then delete old one
				$oldFile = $request->oldBanner;
				if( $oldFile != ''){

					$file_path = "public/user/photo/".$oldFile;
					Storage::delete($file_path);
				}
	
			}

			$model->save();

			// Activity Log
			activity()->log('Update User Information from Profile.');

			return response()->json(['message' => _lang('Profile Update.'), 'loat' => true]);
		}
   	}

	// Password Change Action
	public function password_change(Request $request)
	{
		if ($request->ajax()) {
			$validator = $request->validate([
			'password' => ['required', 'string', 'min:6', 'confirmed'],
			]);

			$id =Auth::user()->id;
			$model =User::findOrFail($id);
			$model->password=Hash::make($request->password);
			$model->save();

			// Activity Log
			activity()->log('Change the password from profile');

			return response()->json(['message' => _lang('Password Change.')]);
		}
	}

	// mylog
	public function mylog() {
		return view('admin.log.index');
	}

	// mylog_datatable
	public function mylog_datatable() {
		if (request()->ajax()) {
            $models = \LogActivity::logActivityLists();
			return DataTables::of($models)
                ->addIndexColumn()
                ->editColumn('url', function($model){
                    return '<sapn class="text-success">'. $model->url . '</span>';
                })
                ->editColumn('method', function($model){
                    return ($model->method == 'GET' ? '<span class="badge badge-info">GET</span>' : '<span class="badge badge-danger">POST</span>' ) ;
                })
                ->editColumn('ip', function($model){
                    return '<sapn class="text-warning">'. $model->ip . '</span>';
                })
                ->editColumn('agent', function($model){
                    return '<sapn class="text-danger">'. $model->agent . '</span>';
                })
                ->editColumn('user_id', function($model){
                    return '<sapn>'. $model->user->username . '</span>';
                })
				->rawColumns(['url', 'method', 'ip', 'agent', 'user_id'])->make(true);

		}
	}
}

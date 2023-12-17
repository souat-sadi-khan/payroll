<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['install']], function () {
Route::get('/', function () {
    // return redirect()->route('login');
	return view('welcome');
});
Auth::routes();
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
	//ui:::::::::::::::::::
		 Route::get('/profile', 'UiController@index')->name('profile');
		 Route::post('/profile', 'UiController@postprofile')->name('postprofile');
		Route::get('/my-log', 'UiController@mylog')->name('my-log');
		Route::get('my-log/datatable', 'UiController@mylog_datatable')->name('my-log.datatable');
		 Route::post('/password', 'UiController@password_change')->name('password');

		/*::::::::::::::Employee Section:::::::::*/
		Route::get('department', 'Configuration\Employee\EmployeeController@Department_index')->name('department.index');
		Route::get('department/datatable', 'Configuration\Employee\EmployeeController@Department_datatable')->name('department.datatable');
		Route::get('department/create', 'Configuration\Employee\EmployeeController@Department_create')->name('department.create');
		Route::any('department/store', 'Configuration\Employee\EmployeeController@Department_store')->name('department.store');
		Route::get('department/edit/{id?}', 'Configuration\Employee\EmployeeController@Department_edit')->name('department.edit');
		Route::any('department/update/{id}', 'Configuration\Employee\EmployeeController@Department_update')->name('department.update');
		Route::delete('department/delete/{id}', 'Configuration\Employee\EmployeeController@Department_delete')->name('department.delete');
		//:::::::::::::::::::::::::::::Employee Document Type::::::::::::::::::::::::::::::::::::
		Route::get('document/datatable', 'Configuration\Employee\EmployeeDocumentTypeController@datatable')->name('document.datatable');
		Route::resource('document-type', 'Configuration\Employee\EmployeeDocumentTypeController');

		//:::::::::::::::::::::::::::::Employee Category::::::::::::::::::::::::::::::::::::
		Route::get('category-datatable', 'Configuration\Employee\EmployeeCategoryController@datatable')->name('category.datatable');
		Route::resource('category', 'Configuration\Employee\EmployeeCategoryController');

		// ::::::::::::::::::::::::::::::  Employee Shift ::::::::::::::::::::::::::::::::::::::
		Route::get('shift-datatable', 'Configuration\Employee\EmployeeShiftController@datatable')->name('shift.datatable');
		Route::resource('shift', 'Configuration\Employee\EmployeeShiftController');

		//:::::::::::::::::::::::::::::Employee leave type:::::::::::::::::::::::::::::::
		Route::get('leave-type-datatable', 'Configuration\Employee\EmployeeLeaveTypeController@datatable')->name('leave_type.datatable');
		Route::resource('leave-type', 'Configuration\Employee\EmployeeLeaveTypeController');

		//:::::::::::::::::::::::::::::Employee leave Allocation:::::::::::::::::::::::::::::::
		Route::get('employee-leave', 'Configuration\Employee\EmployeeLeaveTypeController@view')->name('employee-leave.view');
		Route::get('employee-leave-allocation-datatable', 'Configuration\Employee\EmployeeLeaveAllocationController@datatable')->name('leave_allocation.datatable');
		Route::resource('employee-leave-allocation', 'Configuration\Employee\EmployeeLeaveAllocationController');

		//:::::::::::::::::::::::::::::Employee leave Request:::::::::::::::::::::::::::::::
		Route::get('employee-leave-request-datatable', 'Configuration\Employee\EmployeeLeaveRequestController@datatable')->name('leave_request.datatable');
		Route::post('employee-leave-request-details', 'Configuration\Employee\EmployeeLeaveRequestController@details')->name('employee-leave-request.details');
		Route::resource('employee-leave-request', 'Configuration\Employee\EmployeeLeaveRequestController');

		//:::::::::::::::::::::: Employee Pay Head ::::::::::::::::::::::::::::::
		Route::get('pay-head-datatable', 'Configuration\Employee\EmployeePayHeadController@datatable')->name('pay_head.datatable');
		Route::resource('pay-head', 'Configuration\Employee\EmployeePayHeadController');

		//:::::::::::::::::::::: Employee Pay Roll ::::::::::::::::::::::::::::::
		Route::get('payroll', 'Configuration\Employee\EmployeePayRollTemplateController@view')->name('payroll.view');
		Route::get('payroll-template-datatable', 'Configuration\Employee\EmployeePayRollTemplateController@datatable')->name('payroll-template.datatable');
		Route::resource('payroll-template', 'Configuration\Employee\EmployeePayRollTemplateController');
		
		// employee_salary_structure
		Route::resource('payroll-s-structure', 'Configuration\Employee\EmployeeSalaryStructureController');
		Route::post('employee-s-structure.ajax', 'Configuration\Employee\EmployeeSalaryStructureController@ajaxcall')->name('employee-s-structure.ajax');
		Route::get('employee-s-structure-datatable', 'Configuration\Employee\EmployeeSalaryStructureController@datatable')->name('employee-s-structure.datatable');
		
		// ::::::::::::::::::::::::::::::::::::::::::::::::::   Payroll ::::::::::::::::::::::::::::::::::::::::::::;;;;
		Route::get('payroll-initialize-datatable', 'Employee\PayrollController@datatable')->name('payroll-initialize.datatable');
		Route::get('payroll-initialize/print/{id}', 'Employee\PayrollController@print')->name('payroll-initialize.print');
		Route::post('payroll-initialize-step_one', 'Employee\PayrollController@step_one')->name('payroll-initialize.step_one');
		Route::resource('payroll-initialize', 'Employee\PayrollController');

		// ::::::::::::::::::::::::::::::::::::::::::::::::  Payroll Transection :::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('payroll-transection-datatable', 'Employee\PayrollTransectionController@datatable')->name('payroll-transection.datatable');
		Route::get('transaction-print/{id}', 'Employee\PayrollTransectionController@print')->name('transaction_print');
		Route::post('check_payment_method', 'Employee\PayrollTransectionController@ajax')->name('check_payment_method');
		Route::post('/check_advane_return', 'Employee\PayrollTransectionController@check_advane_return')->name('check_advane_return');
		Route::post('/check_employee_payroll', 'Employee\PayrollTransectionController@check_employee_payroll')->name('check_employee_payroll');
		Route::resource('payroll-transection', 'Employee\PayrollTransectionController');

		// ::::::::::::::::::::		Holiday section	 ::::::::::::::::::::::::::::::
		Route::get('calender/datable', 'Configuration\Employee\HolidayController@datatable')->name('holiday.datatable');
		Route::resource('holiday', 'Configuration\Employee\HolidayController');

		//:::::::::::::::::::::::::::::Designation::::::::::::::::::::::::::
		Route::get('designation-datatable', 'Configuration\Employee\DesignationController@datatable')->name('designation.datatable');
		Route::resource('designation', 'Configuration\Employee\DesignationController');

		//:::::::::::::::::::::::::::::Employee Attendance Type:::::::::::::::::::::::::::::::::
		Route::get('attendance-type-datatable', 'Configuration\Employee\EmployeeAttendanceTypeController@datatable')->name('attendance-type.datatable');
		Route::resource('attendance-type', 'Configuration\Employee\EmployeeAttendanceTypeController');

		//:::::::::::::::::::::::::::::Employee List::::::::::::::::::::::::::::::::::::
		Route::get('employee-list-datatable', 'Configuration\Employee\EmployeeListController@datatable')->name('list.datatable');
		Route::resource('employee-list', 'Configuration\Employee\EmployeeListController');
		Route::post('admin/employee-list/basic_info', 'Configuration\Employee\EmployeeListController@Store_Basic_Info')->name('employee-list.basic_info');
		Route::post('admin/employee-list/contact_info', 'Configuration\Employee\EmployeeListController@Store_Contact_Info')->name('employee-list.contact_info');
		Route::any('employee-list/Image_Upload/{id}', 'Configuration\Employee\EmployeeListController@Image_Upload')->name('employee-list.Image_Upload');

		// Route for Employee Basic Info
			Route::get('/ajax/basic_info', 'Configuration\Employee\EmployeeListController@basic_info')->name('ajax.basic_info');
			Route::post('/employee/basic_info/update', 'Configuration\Employee\EmployeeListController@update_basic_info')->name('employee.basic_info.update');

		// Route for Employee Contact Info
			Route::get('/ajax/contact_info', 'Configuration\Employee\EmployeeListController@contact_info')->name('ajax.contact_info');
			Route::post('/employee/contact_info/update', 'Configuration\Employee\EmployeeListController@update_contact_info')->name('employee.contact_info.update');

		//  Route for Employee Document Info
			Route::get('/ajax/document_info', 'Employee\DocumentController@document_info')->name('ajax.document_info');
			// Route::resource('/employee-document/{id}', 'Employee\DocumentController');
			Route::get('/employee-document/create/{id}', 'Employee\DocumentController@create')->name('employee-document.create');
			Route::post('/employee-document/store', 'Employee\DocumentController@store')->name('employee-document.store');
			Route::get('/employee-document/show/{id}', 'Employee\DocumentController@show')->name('employee-document.show');
			Route::get('/employee-document/edit/{id}', 'Employee\DocumentController@edit')->name('employee-document.edit');
			Route::patch('/employee-document/update/{id}', 'Employee\DocumentController@update')->name('employee-document.update');
			Route::delete('/employee-document/destroy/{id}', 'Employee\DocumentController@destroy')->name('employee-document.destroy');
		// Route for Employee Account Info
			Route::get('/ajax/qua_info', 'Employee\QualificationController@qua_info')->name('ajax.qua_info');
			Route::get('/employee-qua/create/{id}', 'Employee\QualificationController@create')->name('employee-qua.create');
			Route::post('/employee-qua/store', 'Employee\QualificationController@store')->name('employee-qua.store');
			Route::get('/employee-qua/show/{id}', 'Employee\QualificationController@show')->name('employee-qua.show');
			Route::get('/employee-qua/edit/{id}', 'Employee\QualificationController@edit')->name('employee-qua.edit');
			Route::patch('/employee-qua/update/{id}', 'Employee\QualificationController@update')->name('employee-qua.update');
			Route::delete('/employee-qua/destroy/{id}', 'Employee\QualificationController@destroy')->name('employee-qua.destroy');
			
		// Route for Employee Account Info
			Route::get('/ajax/account_info', 'Employee\AccountController@account_info')->name('ajax.account_info');
			Route::get('/ajax/account/info/{id}', 'Employee\AccountController@create')->name('account.create');
			Route::post('/ajax/account/info/store/{id}', 'Employee\AccountController@store')->name('account.store');
			Route::delete('/ajax/account/info/destroy/{id}', 'Employee\AccountController@destroy')->name('account.destroy');
			Route::get('/ajax/account/info/edit/{id}', 'Employee\AccountController@edit')->name('account.edit');
			Route::get('/ajax/account/info/show/{id}', 'Employee\AccountController@show')->name('account.show');
			Route::patch('/ajax/account/info/update/{id}', 'Employee\AccountController@update')->name('account.update');

		// Route for Employee Designation Info
			Route::get('/ajax/desig_info', 'Employee\DesignationController@desig_info')->name('ajax.desig_info');
			
			// Route for Employee Designation add for
				Route::get('/designation_history/add', 'Employee\DesignationController@add_desig')->name('designation.add');
			Route::get('/designation_history/desig_info', 'Employee\DesignationController@desig_info')->name('ajax.desig_info');

		// Route for Employee Designation add for
			Route::get('/designation_history/add/{id}', 'Employee\DesignationController@add_desig')->name('designation.add');

		// Route for Employee  Designation Insert
			Route::post('/designation_history/store/', 'Employee\DesignationController@store')->name('designation.store_designation');

		// Route for Employee  Designation show
			Route::get('/designation_history/show/{id}', 'Employee\DesignationController@show')->name('designation.show_designation');

		// Route for Employee  Designation edit
			Route::get('/designation_history/edit/{id}', 'Employee\DesignationController@edit')->name('designation.edit_designation');

		// Route for Employee  Designation delete
			Route::delete('/designation_history/{id}', 'Employee\DesignationController@destroy')->name('designation.delete_designation');

		// Route for Employee  Designation update
			Route::patch('/designation_history/update/{id}', 'Employee\DesignationController@update')->name('designation.update_designation');

		// Route for Employee Term History
			Route::get('/term_history/term_info', 'Employee\TermController@term_info')->name('term_info');


		// Route for Employee  term show
			Route::get('/term_history/show/{id}', 'Employee\TermController@show')->name('term.show_term');

		// Route for Employee  term edit
			Route::get('/term_history/edit/{id}', 'Employee\TermController@edit')->name('term.edit_term');
			Route::patch('/term_history/update_term/{id}', 'Employee\TermController@update')->name('term.update_term');

		// Route for Employee  term edit
			Route::delete('/term_history/{id}', 'Employee\TermController@destroy')->name('term.delete_term');

		// Route for Employee  term update
			Route::patch('/term_history/update/{id}', 'Employee\TermController@update')->name('term.update_term');


		// Route for Employee Login Info
			Route::get('/ajax/login_info', 'UserController@login_info')->name('ajax.login_info');
			Route::any('/employee-details/login_info/{id}', 'UserController@set_login_info')->name('employee-details.login_info');
			
		

		//:::::::::::::::::::::::::::::Employee Payhead::::::::::::::::::::::::::::::::::::
		// Route::resource('employee-payhead', 'Configuration\Employee\EmployeePayHeadController');

		//  ::::::::::::::::::::::::::::: Member Setting :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('setting/member-setting', 'Configuration\Member\MemberSettingDashboardController@index')->name('member-setting');

			// Member Setting Nationality :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('setting/member-setting/nationality', 'Configuration\Member\Member_Nationality_Setting_Controller@index')->name('setting.member-setting.nationality');
			Route::get('setting/member-setting/nationality-datatable', 'Configuration\Member\Member_Nationality_Setting_Controller@datatable')->name('setting.member-setting.nationality.datatable');
			Route::get('setting/member-setting/nationality/create', 'Configuration\Member\Member_Nationality_Setting_Controller@create')->name('setting.member-setting.nationality.create');
			Route::post('setting/member-setting/nationality/store', 'Configuration\Member\Member_Nationality_Setting_Controller@store')->name('setting.member-setting.nationality.store');
			Route::get('setting/member-setting/nationality/edit/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@edit')->name('setting.member-setting.nationality.edit');
			Route::patch('setting/member-setting/nationality/update/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@update')->name('setting.member-setting.nationality.update');
			Route::delete('setting/member-setting/nationality/destroy/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@destroy')->name('setting.member-setting.nationality.destroy');

			// Member Setting Religious :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('setting/member-setting/religious', 'Configuration\Member\Member_Religious_Setting_Controller@index')->name('setting.member-setting.religious');
			Route::get('setting/member-setting/religious-datatable', 'Configuration\Member\Member_Religious_Setting_Controller@datatable')->name('setting.member-setting.religious.datatable');
			Route::get('setting/member-setting/religious/create', 'Configuration\Member\Member_Religious_Setting_Controller@create')->name('setting.member-setting.religious.create');
			Route::post('setting/member-setting/religious/store', 'Configuration\Member\Member_Religious_Setting_Controller@store')->name('setting.member-setting.religious.store');
			Route::get('setting/member-setting/religious/edit/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@edit')->name('setting.member-setting.religious.edit');
			Route::patch('setting/member-setting/religious/update/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@update')->name('setting.member-setting.religious.update');
			Route::delete('setting/member-setting/religious/destroy/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@destroy')->name('setting.member-setting.religious.destroy');

			// Member Setting Occupation :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('setting/member-setting/occupation', 'Configuration\Member\Member_Occupation_Setting_Controller@index')->name('setting.member-setting.occupation');
			Route::get('setting/member-setting/occupation-datatable', 'Configuration\Member\Member_Occupation_Setting_Controller@datatable')->name('setting.member-setting.occupation.datatable');
			Route::get('setting/member-setting/occupation/create', 'Configuration\Member\Member_Occupation_Setting_Controller@create')->name('setting.member-setting.occupation.create');
			Route::post('setting/member-setting/occupation/store', 'Configuration\Member\Member_Occupation_Setting_Controller@store')->name('setting.member-setting.occupation.store');
			Route::get('setting/member-setting/occupation/edit/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@edit')->name('setting.member-setting.occupation.edit');
			Route::patch('setting/member-setting/occupation/update/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@update')->name('setting.member-setting.occupation.update');
			Route::delete('setting/member-setting/occupation/destroy/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@destroy')->name('setting.member-setting.occupation.destroy');

		/*::::::::::::::Member List Section:::::::::*/
		Route::resource('member-list', 'Configuration\Member\MemberController');


		
		// Employee Section End

		// Finance Section
		Route::group(['as' => 'finance.', 'prefix' => 'finance', 'namespace' => 'Finance', 'middleware' => ['auth']], function () {

			/*::::::::::::::::::::::::::::::::::::::: Finance Dashboard ::::::::::::::::::::::::::::::::::*/
			Route::get('/', 'DashboardController@index')->name('index');

			/*:::::::::::::::::::::::::::::::::::::::: Accounts :::::::::::::::::::::::::::::::::::::*/
			Route::get('accounts/datatable', 'AccountController@datatable')->name('account.datatable');
			Route::resource('account', 'AccountController');

			/*:::::::::::::::::::::::::::::::::::::::: Deposit :::::::::::::::::::::::::::::::::::::::*/
			Route::get('deposit/datatable', 'DepositController@datatable')->name('deposit.datatable');
			Route::resource('deposit', 'DepositController');

			/*:::::::::::::::::::::::::::::::::::::::: Expense ::::::::::::::::::::::::::::::::::::::*/
			Route::get('expense/datatable', 'ExpenseController@datatable')->name('expense.datatable');
			Route::resource('expense', 'ExpenseController');

			/*::::::::::::::::::::::::::::::::::::::::: Transfer ::::::::::::::::::::::::::::::::::::::*/
			Route::get('transfer/datatable', 'TransferController@datatable')->name('transfer.datatable');
			Route::resource('transfer', 'TransferController');

		});

		// HR Section
		Route::group(['as' => 'hr.', 'prefix' => 'hr', 'namespace' => 'Hr', 'middleware' => ['auth']], function () {

			/*:::::::::::::::::::::::::::::::::::::::::::: Award Type :::::::::::::::::::::::::::::::::::*/
			Route::get('award-type/datatable', 'AwardTypeController@datatable')->name('award-type.datatable');
			Route::resource('award-type', 'AwardTypeController');

			/*:::::::::::::::::::::::::::::::::::::::::::: Award ::::::::::::::::::::::::::::::::::::::::*/
			Route::get('award/datatable', 'AwardController@datatable')->name('award.datatable');
			Route::resource('award', 'AwardController');

			/*::::::::::::::::::::::::::::::::::::::::::: Resign :::::::::::::::::::::::::::::::::::::::::*/
			Route::get('resign/datatable', 'ResignController@datatable')->name('resign.datatable');
			Route::resource('resign', 'ResignController');

			/*::::::::::::::::::::::::::::::::::::::::::: Employee Transfer ::::::::::::::::::::::::::::::*/
			Route::get('transfer/datatable', 'TransferController@datatable')->name('transfer.datatable');
			Route::get('get_employee_designation', 'TransferController@get_employee_designation')->name('get_employee_designation');
			Route::resource('transfer', 'TransferController');

			/*::::::::::::::::::::::::::::::::::::::::::: Travel Controller ::::::::::::::::::::::::::::::*/
			Route::get('travel/datatable', 'TravelController@datatable')->name('travel.datatable');
			Route::resource('travel', 'TravelController');

		});

		// Employee Id Card Section

		Route::get('setting/id-card-template', 'IdCardController@index')->name('id-card-template');
		Route::get('id-card/', 'IdCardController@id_card')->name('id-card.id_card');
		Route::post('/employee-id-card/show', 'IdCardController@show')->name('employee-id-card.show');

		Route::get('setting/id-card-template/create', 'IdCardController@create')->name('id-card-template.create');
		Route::post('setting/id-card-template/store', 'IdCardController@store')->name('id-card-template.store');
		Route::any('setting/id-card-template/datatable', 'IdCardController@datatable')->name('id-card-template.datatable');
		Route::get('setting/id-card-template/edit/{id}', 'IdCardController@edit')->name('id-card-template.edit');
		Route::patch('setting/id-card-template/update/{id}', 'IdCardController@update')->name('id-card-template.update');
		Route::delete('setting/id-card-template/destroy/{id}', 'IdCardController@destroy')->name('id-card-template.destroy');

		Route::any('setting/general-setting','SettingController@index')->name('setting');
		Route::any('setting/system-setting','SettingController@SystemConfiguration')->name('system.setting');
		Route::any('setting/mail-setting','SettingController@MainConfiguration')->name('mail.setting');
		Route::any('setting/sms-setting','SettingController@SmsConfiguration')->name('sms.setting');
		Route::any('setting/module-setting','SettingController@ModudelConfiguraion')->name('module.setting');
		Route::get('backup','SettingController@getBackup')->name('backup');
		Route::get('language','LanguageController@index')->name('language');
		Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');

		Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');

	 	/*::::::::::::::user role Permission:::::::::*/
		Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::get('/datatable', 'UserController@datatable')->name('datatable');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');
		});

	});

Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('/documentation', 'DocumentationController@index')->name('doc');


Route::get('/contact_form_submit', 'Frontend/Front_End_Controller@contact_form_submit')->name('contact_form_submit');

Route::get('/installs', 'Install\InstallController@index');
Route::get('install/database', 'Install\InstallController@database');
Route::post('install/process_install', 'Install\InstallController@process_install');
Route::get('install/create_user', 'Install\InstallController@create_user');
Route::post('install/store_user', 'Install\InstallController@store_user');
Route::get('install/system_settings', 'Install\InstallController@system_settings');
Route::post('install/finish', 'Install\InstallController@final_touch');	

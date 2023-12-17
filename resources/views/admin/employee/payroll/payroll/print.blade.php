@php
    $emp = App\models\employee\Employee::where('id', $salary->employee_id)->firstOrFail();
    $present = 0;
    $absent = 0;
    $holiday = 0;
    $default_holiday = 0;
    $total_earning  = 0;
    $total_deduction  = 0;

    $attendance_types = App\models\employee\EmployeeAttendanceType::where('is_active', 1)->get();

@endphp

@foreach ($attendance_types as $item)

    @php
        
        $present = 0;
        $absent = 0;
        $holiday = 0;
        $default_holiday = 0;

    @endphp

    <tr>

        <td>
            <span class="float-right">

                @php


                    $dt = Carbon\Carbon::create($start_date);
                    $dt2 = Carbon\Carbon::create($end_date);

                    $period = Carbon\CarbonPeriod::create($dt , $dt2);
                    
                    foreach($period as $date) {
                        if($date->isWeekend()) {
                            $query = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->where('date_of_attendance', $date)->where('employee_attendance_type_id', 1)->first();
                            if(!$query) {
                                $default_holiday = $default_holiday + 1;
                            }
                        }
                    }

                    $holiday = $holiday + $default_holiday;

                
                    $query = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->whereBetween('date_of_attendance', [$start_date, $end_date])->where('employee_attendance_type_id', $item->id)->where('employee_attendance_type_id', '!=', 3)->count();

                    // check present date
                    $check_present = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->whereBetween('date_of_attendance', [$start_date, $end_date])->where('employee_attendance_type_id', 1)->count();

                    // check the default holiday


                    $present = $check_present + $present;

                    // check holiday

                    $check_holiday = App\models\holiday\Holiday::whereBetween('date', [$start_date, $end_date])->get();

                    // check employee is present on the holiday

                    foreach($check_holiday as $holi) {

                        $holiday_date = $holi->date;

                        $check = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->where('date_of_attendance', $holiday_date)->first();

                        if(!$check) {

                            $holiday = $holiday + 1;
                        
                        }

                    }

                @endphp
                
            </span>

        </td>

    </tr>

@endforeach
@extends('layouts.print', ['title' => _lang('Payroll Invoice')])

@section('print.main')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-primary py-2">
                    <p class="text-uppercase h5 text-center text-light font-weight-light mb-0">Employee Payroll Invoice </p>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <p class="text-primary h2 mb-2">
                    @if(get_option('logo'))
    
                        <img style="width:100px;" src="{{asset('storage/logo')}}/{{get_option('logo')}}" alt="">
                    
                    @else 
                
                        <img style="width:250px;;" src="{{asset('logo.png')}}" alt="Company Logo">
                    
                    @endif
                </p>
                <p class="h2 text-primary"> {{ get_option('institute_name') }} </p>
                <p class="mb-1"> {{ get_option('site_title') }}</p>
                <p class="mb-1"> {{ get_option('address') != '' ? get_option('address') : 'Please Enter Your Address From General Settings' }} </p>
                <p class="mb-1"> {{ get_option('city') != '' ? get_option('city') : 'Please Enter Your City From General Settings' }} </p>
                <p class="mb-1"> {{ get_option('state') != '' ? get_option('state') : 'Please Enter Your State From General Settings' }} </p>
                <p class="mb-1"> {{ get_option('country') != '' ? get_option('country') : 'Please Enter Your Country From General Settings' }} </p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1 font-weight-bold"> BILL TO : </p>
                <p class="h5"> {{ find_employee_name_using_employee_id($salary->employee_id) }} ({{ $emp->prefix.numer_padding($emp->code, get_option('digits_employee_code')) }}) </p>
                <p class="mb-1"> {{ employee_designation($salary->employee_id )}} ( <strong>{{employee_department($salary->employee_id)}} </strong> )</p>
                <p class="mb-1"> {{ $emp->contact_number }} </p>
            </div>
            <div class="col-md-6 text-right">
                <p class="mb-1 font-weight-bold text-uppercase"> Invoice# </p>
                <p class="mb-1 "> Payroll #{{$model->id}} </p>
                <p class="mb-1 font-weight-bold text-uppercase"> Payroll Period </p>
                <p class="mb-1"> {{ formatDate($model->start_date) }} to {{ formatDate($model->end_date) }} </p>
                <p class="mb-1 font-weight-bold text-uppercase"> Invoice Print Date </p>
                <p class="mb-1"> {{formatDate(date('d-m-Y'))}} </p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">Earning Salary</th>
                            <th class="text-center">Deduction Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        @php
                                            $items = App\models\employee\PayrollDetail::where('payroll_id', $model->id)->get();
                                        @endphp
            
                                        @foreach ($items as $item)
                                            @php
                                                $pay_head_id = $item->pay_head_id;
                                                $pay_head = App\models\employee\PayHead::where('id', $pay_head_id)->first();
                                                $type = $pay_head->type;
                                            @endphp
                                            @if ($type == 'Earning')
                                                @php
                                                    $total_earning = $total_earning + $item->amount;
                                                @endphp
                                                <tr>
                                                    <td width="50%">{{$pay_head->name}}</td>
                                                    <td style="text-align: right;"> {{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{round($item->amount)}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>  
                            </td>
                            <td>
                                <table class="no-border">
                                    <tbody>
                                        @php
                                            $items = App\models\employee\PayrollDetail::where('payroll_id', $model->id)->get();
                                        @endphp
        
                                        @foreach ($items as $item)
                                            @php
                                                $pay_head_id = $item->pay_head_id;
                                                $pay_head = App\models\employee\PayHead::where('id', $pay_head_id)->first();
                                                $type = $pay_head->type;
                                            @endphp
                                            @if ($type == 'Deduction')
                                                @php
                                                    $total_deduction = $total_deduction + $item->amount;
                                                @endphp
                                                <tr>
                                                    <td width="50%">{{$pay_head->name}}</td>
                                                    <td style="text-align: right;"> {{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{round($item->amount)}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td width="50%">Total Earning</td>
                                        <td class="text-right">{{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_earning}}</td>
                                    </tr>
                                </table>          
                            </td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td width="50%">Total Deduction</td>
                                        <td class="text-right">{{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_deduction}}</td>
                                    </tr>
                                </table>       
                            </td>
                        </tr>
                        <tr>
                            <th>Net Salary</th>
                            <th style="text-align: right;">{{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_earning - $total_deduction}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="container-fluid fotter-bottom">
        <div class="row mt-3 mb-5">
            <div class="col-md-6">
                <p class="text-uppercase font-weight-bold"> remarks : </p>
                <p> {{ $model->remarks }} </p>
            </div>
            <div class="col-md-6 text-right">
                  <p class="text-uppercase font-weight-bold"> total </p>
                  <p class="h1 text-primary"> {{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_earning - $total_deduction}} </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 text-center mx-auto">
                <span class="font-weight-bold"> Power By &nbsp; </span> 
                <img src="{{ asset('logo.png') }}" alt="" style="width: 120px">
                <p> <small>All right reserved MD SOUAT SADI KHAN (SADIK) @ {{ date('Y')}}</small></p>
            </div>
        </div>
        
    </div>
@endsection
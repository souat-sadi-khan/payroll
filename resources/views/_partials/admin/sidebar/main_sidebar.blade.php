{{-- Dashboard --}}
<li data-placement="bottom" title="Go to home">
        <a class="app-menu__item {{ Request::is('home') ? ' active' : '' }}" href="{{ route('home') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">
                        {{_lang('dashboard')}}
                </span>
        </a>
</li>
        
{{-- Employee --}}
@can('employee.view')

        {{-- Employee Shift --}}
        @can('employee_shift.view')
                <li data-placement="bottom" title="Ecommerce Offer Section">
                        <a class="app-menu__item {{Request::is('admin/shift*') ? 'active':''}}" href="{{ route('admin.shift.index') }}">
                                <i class="app-menu__icon fa fa-clock-o"></i>
                                <span class="app-menu__label">
                                        {{_lang('Time Schedule')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Category --}}
        @can('employee_category.view')
                <li data-placement="bottom" title="Employee Category">
                        <a class="app-menu__item {{ Request::is('admin/category*') ? ' active' : '' }}" href="{{ route('admin.category.index') }}">
                                <i class="app-menu__icon fa fa-diamond"></i>
                                <span class="app-menu__label">
                                        {{_lang('Category')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Designation --}}
        @can('employee-designation.view')
                <li data-placement="bottom" title="Employee Designation">
                        <a class="app-menu__item {{Request::is('admin/designation*') ? 'active':''}}" href="{{ route('admin.designation.index') }}">
                                <i class="app-menu__icon fa fa-graduation-cap"></i>
                                <span class="app-menu__label">
                                        {{_lang('Designation')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Department --}}
        @can('employee_departmeent.view')
                <li data-placement="bottom" title="Employee Department">
                        <a class="app-menu__item {{Request::is('admin/department*') ? 'active':''}}" href="{{ route('admin.department.index') }}">
                                <i class="app-menu__icon fa fa-building"></i>
                                <span class="app-menu__label">
                                        {{_lang('Department')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Document Type --}}
        @can('employee_document_type.view')
                <li data-placement="bottom" title="Employee Document Type">
                        <a class="app-menu__item {{Request::is('admin/document-type*') ? 'active':''}}"  href="{{ route('admin.document-type.index') }}">
                                <i class="app-menu__icon fa fa-book"></i>
                                <span class="app-menu__label">
                                        {{_lang('Document Type')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Leave Type --}}
        @can('employee_leave_type.view')
                <li data-placement="bottom" title="Employee Leave Type">
                        <a class="app-menu__item {{Request::is('admin/leave-type*') ? 'active':''}}" href="{{ route('admin.leave-type.index') }}">
                                <i class="app-menu__icon fa fa-connectdevelop"></i>
                                <span class="app-menu__label">
                                        {{_lang('Leave Type')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Id Card --}}
        @can('employee_id_card.view')
                <li data-placement="bottom" title="Employee Id Card">
                        <a class="app-menu__item {{Request::is('admin/id-card*') ? 'active':''}}" href="{{ route('admin.id-card.id_card') }}">
                                <i class="app-menu__icon fa fa-id-badge"></i>
                                <span class="app-menu__label">
                                        {{_lang('Id Card')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Attendance Type --}}
        @can('employee_attendance_type.view')
                <li data-placement="bottom" title="Employee Attendance Type">
                        <a class="app-menu__item {{Request::is('admin/attendance-type*') ? 'active':''}}" href="{{ route('admin.attendance-type.index') }}">
                                <i class="app-menu__icon fa fa-calendar-o"></i> 
                                <span class="app-menu__label">
                                        {{_lang('Attendance Type')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee list --}}
        @can('employee_list.view')
                <li data-placement="bottom" title="Employee">
                        <a class="app-menu__item {{Request::is('admin/employee-list*') ? 'active':''}}" href="{{ route('admin.employee-list.index') }}">
                                <i class="app-menu__icon fa fa-users"></i>
                                <span class="app-menu__label">
                                        {{_lang('Employee List')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Payhead Type --}}
        @can('employee_payhead.view')
                <li data-placement="bottom" title="Payhaed">
                        <a class="app-menu__item {{Request::is('admin/pay-head*') ? 'active':''}}" href="{{ route('admin.pay-head.index') }}">
                                <i class="app-menu__icon fa fa-empire"></i>
                                <span class="app-menu__label">
                                        {{_lang('Payhead')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Holiday --}}
        @can('holiday.view')
                <li data-placement="bottom" title="Payhaed">
                        <a class="app-menu__item {{Request::is('admin/holiday*') ? 'active':''}}" href="{{ route('admin.holiday.index') }}">
                                <i class="app-menu__icon fa fa-calendar"></i>
                                <span class="app-menu__label">
                                        {{_lang('Holiday')}}
                                </span>
                        </a>
                </li>
        @endcan

        {{-- Employee Leave --}}
        @can('employee_leave.access')
                <li data-placement="bottom" title="Employee Leave" class="treeview {{ Request::is('admin/employee*') ? ' is-expanded' : '' }}">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-cube"></i>
                                <span class="app-menu__label">
                                        {{_lang('Leave')}}
                                </span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                
                        <ul class="treeview-menu">

                                {{-- Employee Leave View --}}
                                @can('employee_leave.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/employee-leave') ? 'active':''}}" href="{{ route('admin.employee-leave.view') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('View Leave')}}
                                                </a>
                                        </li>
                                @endcan

                                @can('employee_leave_allocation.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/employee-leave-allocation*') ? 'active':''}}" href="{{ route('admin.employee-leave-allocation.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Leave Allocation')}}
                                                </a>
                                        </li>
                                @endcan

                                @can('employee_leave.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/employee-leave-request*') ? 'active':''}}" href="{{ route('admin.employee-leave-request.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Leave Request')}}
                                                </a>
                                        </li>
                                @endcan
                        </ul>
                </li>
        @endcan  

        {{-- Finance Department --}}
        @can('Finance.access')
                <li data-placement="bottom" title="Finance Department" class="treeview {{ Request::is('admin/finance*') ? ' is-expanded' : '' }}">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-money"></i>
                                <span class="app-menu__label">
                                        {{_lang('Finance')}}
                                </span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                
                        <ul class="treeview-menu">

                                {{-- Dashboard --}}
                                <li class="mt-1">
                                        <a class="treeview-item {{Request::is('admin/finance') ? 'active':''}}" href="{{ route('admin.finance.index') }}">
                                                <i class="icon fa fa-circle-o"></i>
                                                {{_lang('Dashboard')}}
                                        </a>
                                </li>

                                {{-- Finance Account --}}
                                @can('finance_account.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/finance/account') ? 'active':''}}" href="{{ route('admin.finance.account.index') }}">
                                                        <i class="icon fa fa-bullseye"></i>
                                                        {{_lang('Account')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Finance Deposit --}}
                                @can('finance_deposit.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/finance/deposit') ? 'active':''}}" href="{{ route('admin.finance.deposit.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Deposit')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Finance Expense --}}
                                @can('finance_expense.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/finance/expense') ? 'active':''}}" href="{{ route('admin.finance.expense.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Expense')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Finance Transfer --}}
                                @can('finance_transfer.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/finance/transfer') ? 'active':''}}" href="{{ route('admin.finance.transfer.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Transfer')}}
                                                </a>
                                        </li>
                                @endcan
                        </ul>
                </li>
        @endcan

        {{-- Hr Department --}}
        @can('hr.access')
                <li data-placement="bottom" title="Human Resource Department" class="treeview {{ Request::is('admin/hr*') ? ' is-expanded' : '' }}">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-dropbox"></i>
                                <span class="app-menu__label">
                                        {{_lang('HR')}}
                                </span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
                
                        <ul class="treeview-menu">

                                {{-- Award --}}
                                @can('hr_award.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/hr/award') ? 'active':''}}" href="{{ route('admin.hr.award.index') }}">
                                                        <i class="icon fa fa-bullseye"></i>
                                                        {{_lang('Award')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Resign --}}
                                @can('hr_resign.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/hr/resign') ? 'active':''}}" href="{{ route('admin.hr.resign.index') }}">
                                                        <i class="icon fa fa-bullseye"></i>
                                                        {{_lang('Resignation')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Travel --}}
                                @can('hr_travel.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/hr/travel') ? 'active':''}}" href="{{ route('admin.hr.travel.index') }}">
                                                        <i class="icon fa fa-bullseye"></i>
                                                        {{_lang('Travel')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- HR Transfer --}}
                                @can('hr_transfer.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/hr/transfer') ? 'active':''}}" href="{{ route('admin.hr.transfer.index') }}">
                                                        <i class="icon fa fa-bullseye"></i>
                                                        {{_lang('Transfer')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Award Type --}}
                                @can('hr_award_type.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/hr/award-type') ? 'active':''}}" href="{{ route('admin.hr.award-type.index') }}">
                                                        <i class="icon fa fa-bullseye"></i>
                                                        {{_lang('Award Type')}}
                                                </a>
                                        </li>
                                @endcan
                        </ul>
                </li>
        @endcan

        {{-- Employee Payroll --}}
        @can('employee_payroll.view')
                <li data-placement="bottom" title="Employee PayRoll System" class="treeview {{ Request::is('admin/payroll*') ? ' is-expanded' : '' }}">
                        <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-calculator"></i>
                                <span class="app-menu__label">
                                        {{_lang('Payroll')}}
                                </span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                        </a>
            
                        <ul class="treeview-menu">
                
                                {{-- Employee Payroll --}}
                                @can('employee_payroll.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/payroll') ? 'active':''}}" href="{{ route('admin.payroll.view') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Payroll View')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Payroll Template --}}
                                @can('employee_payroll_template.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/payroll-template') ? 'active':''}}" href="{{ route('admin.payroll-template.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Payroll Template')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Salary Structure --}}
                                @can('employee_payroll.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/payroll-s-structure') ? 'active':''}}" href="{{ route('admin.payroll-s-structure.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Salary Structure')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Payroll --}}
                                @can('employee_payroll.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/payroll-initialize') ? 'active':''}}" href="{{ route('admin.payroll-initialize.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Payroll')}}
                                                </a>
                                        </li>
                                @endcan

                                {{-- Payroll Transaction --}}
                                @can('employee_payroll.view')
                                        <li class="mt-1">
                                                <a class="treeview-item {{Request::is('admin/payroll-transection') ? 'active':''}}" href="{{ route('admin.payroll-transection.index') }}">
                                                        <i class="icon fa fa-circle-o"></i>
                                                        {{_lang('Payroll Transaction')}}
                                                </a>
                                        </li>
                                @endcan

                        </ul>
                </li>
        @endcan

                
        @endcan



        @can('setting.view')
        {{-- Settings --}}
        <li class="treeview {{ Request::is('admin/setting*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span
                    class="app-menu__label">{{_lang('Settings')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('setting.view')
                {{-- General Settings --}}
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/setting/general-setting*') ? 'active':''}}"
                        href="{{ route('admin.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('General Settings')}}</a></li>
                @endcan

                @can('system_configuration.view')
                {{-- System Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/system-setting*') ? 'active':''}}"
                        href="{{ route('admin.system.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('System Configuration ')}}</a></li>
                @endcan

                @can('mail_configuration.view')
                {{-- Mail Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/mail-setting*') ? 'active':''}}"
                        href="{{ route('admin.mail.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Mail Configuration ')}}</a></li>
                @endcan

                @can('sms_configuration.view')
                {{-- SMS Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/sms-setting*') ? 'active':''}}"
                        href="{{ route('admin.sms.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('SMS Configuration ')}}</a></li>
                @endcan

                @can('module_configuration.view')
                {{-- Module Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/module-setting*') ? 'active':''}}"
                        href="{{ route('admin.module.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Module Configuration ')}}</a></li>
                @endcan

                @can('id_card_template.view')
                {{-- Module Configuration --}}
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/setting/id-card-template*') ? 'active':''}}"
                        href="{{ route('admin.id-card-template') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Id Card Template ')}}</a></li>
                @endcan

                @can('member_setting.view')
                {{-- Member Settings Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/member*') ? 'active':''}}"
                        href="{{ route('admin.member-setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Member')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('language.view')
        {{-- Language --}}
        <li><a class="app-menu__item {{ Request::is('admin/language*') ? ' active' : '' }}"
                href="{{ route('admin.language') }}"><i class="app-menu__icon fa fa-language"
                    aria-hidden="true"></i><span class="app-menu__label">{{_lang('language')}}</span></a></li>
        @endcan

        @can('user.view')
        {{-- User Section--}}
        <li class="treeview {{ Request::is('admin/user*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-user-times"></i><span
                    class="app-menu__label">{{_lang('role_and_permission')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('role.view')
                {{-- Role & Permission --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/user/role*') ? 'active':''}}"
                        href="{{ route('admin.user.role') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('role_permission')}}</a></li>
                @endcan

                @can('user.view')
                {{-- User --}}
                <li class="mt-1"><a
                        class="treeview-item {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}"
                        href="{{ route('admin.user.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('user')}}</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('backup.view')
        {{-- Database Backup --}}
        <li><a class="app-menu__item {{ Request::is('admin/backup') ? ' active' : '' }}" href="{{ route('admin.backup') }}"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">{{_lang('backup')}}</span></a></li>
        @endcan

        <li><a target="_blank" class="app-menu__item {{ Request::is('admin/backup') ? ' active' : '' }}" href="https://fontawesome.com/v4.7.0/icons/"><i class="app-menu__icon fa fa-font-awesome"></i><span class="app-menu__label">{{_lang('Font Awosome')}}</span></a></li>

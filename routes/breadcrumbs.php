<?php

// Home

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Settings', route('admin.setting'));
});

// Home > System Configuration
Breadcrumbs::for('system-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('System Configuration', route('admin.system.setting'));
});

// Home > Employee Shift
Breadcrumbs::for('employee-shift', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Shift', route('admin.employee-shift.index'));
});

// Home > mail Configuration
Breadcrumbs::for('mail-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Mail Configuration', route('admin.mail.setting'));
});

// Home > sms Configuration
Breadcrumbs::for('sms-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('SMS Configuration', route('admin.sms.setting'));
});

// Home > Module Configuration
Breadcrumbs::for('module-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Module Configuration', route('admin.module.setting'));
});

// Home > Employee Id Card
Breadcrumbs::for('employee-id-card', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Id Card', route('admin.id-card-template'));
});


// Employee Section

// Home > Employee Department
Breadcrumbs::for('employee-department', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Department', route('admin.employee.department.index'));
});
// Home > Employee Document Type
Breadcrumbs::for('employee-document-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Document Type', route('admin.employee-document-type.index'));
});

// Home > Employee Category
Breadcrumbs::for('employee-category', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Category', route('admin.employee-category.index'));
});


// Home > Employee Category
Breadcrumbs::for('employee-attendance-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Attendance Type', route('admin.employee-attendance-type.index'));
});

// Home > Employee leave
Breadcrumbs::for('employee-leave', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Leave', route('admin.employee-leave.view'));
});

// Home > Employee payroll
Breadcrumbs::for('employee-payroll', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Payroll', route('admin.payroll.view'));
});

// Home > Employee payroll template
Breadcrumbs::for('employee-payroll-template', function ($trail) {
    $trail->parent('employee-payroll');
    $trail->push('Template', route('admin.payroll-template.index'));
});

// Home > Employee payroll Salary Structure
Breadcrumbs::for('employee-payroll-salary-structure', function ($trail) {
    $trail->parent('employee-payroll');
    $trail->push('Salary Structure', route('admin.payroll-s-structure.index'));
});

// Home > Employee leave allocation
Breadcrumbs::for('employee-leave-allocation', function ($trail) {
    $trail->parent('employee-leave');
    $trail->push('Allocation', route('admin.employee-leave-allocation.index'));
});

// Home > Employee leave Request
Breadcrumbs::for('employee-leave-request', function ($trail) {
    $trail->parent('employee-leave');
    $trail->push('Request', route('admin.employee-leave-request.index'));
});

// Home > Employee leave type
Breadcrumbs::for('employee-leave-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Leave Type', route('admin.employee-leave-type.index'));
});

// Home > Employee Pay Head
Breadcrumbs::for('employee-pay-head', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Pay Head', route('admin.employee-pay-head.index'));
});

// Home > Designation
Breadcrumbs::for('designation', function ($trail) {
    $trail->parent('home');
    $trail->push('Designation', route('admin.designation.index'));
});
// Home > Employee list
Breadcrumbs::for('employee-list', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Designation', route('admin.employee-list.index'));
});

// Home > Language
Breadcrumbs::for('language', function ($trail) {
    $trail->parent('home');
    $trail->push('Language', route('admin.language'));
});

// Home > Language > Translate
Breadcrumbs::for('language/edit', function ($trail) {
    $trail->parent('home');
    $trail->push('Language', route('admin.language'));
    $trail->push('Translate', route('admin.language.edit'));
});

// Home > Roles & Permission
Breadcrumbs::for('role', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles & Permission', route('admin.user.role'));
});

// Home > Roles & Permission > Create
Breadcrumbs::for('role/create', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles & Permission', route('admin.user.role'));
    $trail->push('Create', route('admin.user.role.create'));
});

// Home > Roles & Permission > Edit
Breadcrumbs::for('role/edit', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Roles & Permission', route('admin.user.role'));
    $trail->push('Edit', route('admin.user.role.edit', $id));
});

// Home > User
Breadcrumbs::for('/', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.user.index'));
});

// Home > User > Create
Breadcrumbs::for('/create', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.user.index'));
    $trail->push('Create', route('admin.user.create'));
});

// Home > User > Edit
Breadcrumbs::for('/edit', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Users', route('admin.user.index'));
    $trail->push('Edit', route('admin.user.edit', $id));
});

// Home > Employee List > Employee Details
Breadcrumbs::for('/employee-details', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Employee List', route('admin.employee-list.index'));
    $trail->push('Employee Details Information', route('admin.employee-list.edit', $id));
});

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// Recycle Bin Start

// Trash Home 
Breadcrumbs::for('trash', function ($trail) {
    $trail->push('Recycle Bin Home', route('admin.trash.index'));
});

// Home > Trash Employee Catagory
Breadcrumbs::for('trash-employee-category', function($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Category', route('admin.trash.employee-category'));
});

// Home > Trash Employee Department
Breadcrumbs::for('trash-employee-department', function($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Department', route('admin.trash.employee.department'));
});

// Home > Trash Employee Document Type
Breadcrumbs::for('trash-employee-document-type', function($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Document Type', route('admin.trash.employee.document.type'));
});

// Home > Trash Employee Leave Type
Breadcrumbs::for('trash-employee-leave-type', function($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee leave Type', route('admin.trash.employee.leave.type'));
});

// Home > Trash Employee Pay Head
Breadcrumbs::for('trash-employee-pay-head', function($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Pay Head', route('admin.trash.employee.payhead'));
});

// Member Setting Home
Breadcrumbs::for('member_setting', function ($trail) {
    $trail->push('Member Setting Home', route('admin.member-setting'));
});

// Member Home > Nationality
Breadcrumbs::for('setting_member_nationality', function($trail) {
    $trail->parent('member_setting');
    $trail->push('Nationality', route('admin.setting.member-setting.nationality'));
});

// Member Home > Religious
Breadcrumbs::for('setting_member_religious', function($trail) {
    $trail->parent('member_setting');
    $trail->push('Religious', route('admin.setting.member-setting.religious'));
});

// Member Home > Occupation
Breadcrumbs::for('setting_member_occupation', function($trail) {
    $trail->parent('member_setting');
    $trail->push('Occupation', route('admin.setting.member-setting.occupation'));
});
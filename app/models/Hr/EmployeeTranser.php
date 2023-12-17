<?php

namespace App\models\Hr;

use App\models\employee\Department;
use App\models\employee\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeTranser extends Model
{
    // Relation with Employee
    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    // Relation with Department
    public function dept() {
        return $this->belongsTo(Department::class, 'department_from', 'id');
    }
}

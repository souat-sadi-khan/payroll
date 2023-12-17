<?php

namespace App\models\Hr;

use App\models\employee\Employee;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    // Relation with employee
    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}

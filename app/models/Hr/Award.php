<?php

namespace App\models\Hr;

use App\models\employee\Employee;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    // relation with award type
    public function award() {
        return $this->belongsTo(AwardType::class, 'award_type_id', 'id');
    }

    // relation with employee
    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}

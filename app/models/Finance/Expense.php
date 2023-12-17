<?php

namespace App\models\Finance;

use App\models\employee\Employee;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // Relation with Account
    public function account() {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    // Relation with Employee
    public function employee() {
        return $this->belongsTo(Employee::class, 'payers_id', 'id');
    }
}

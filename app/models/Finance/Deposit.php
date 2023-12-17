<?php

namespace App\models\Finance;

use App\models\employee\Employee;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    // relation with account 
    public function account() {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    // realtion with employee
    public function employee() {
        return $this->belongsTo(Employee::class, 'payees_id', 'id');
    }
}
<?php

namespace App\models\Finance;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    // Relation with from account
    public function from_account() {
        return $this->belongsTo(Account::class, 'from_account_id', 'id');
    }

    // Relation with to account
    public function to_account() {
        return $this->belongsTo(Account::class, 'to_account_id', 'id');
    }
}

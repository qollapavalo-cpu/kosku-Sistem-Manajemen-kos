<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = ['bill_id', 'amount', 'payment_date', 'proof_image', 'confirmed_at', 'confirmed_by'];

    public function bill() { return $this->belongsTo(Bill::class); }
    public function admin() { return $this->belongsTo(User::class, 'confirmed_by'); }
}

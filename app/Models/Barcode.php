<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    use HasFactory;

    protected $fillable = ['barcode', 'bottle_id', 'refunded_at', 'withdraw_id', 'withdraw_attempts'];
}

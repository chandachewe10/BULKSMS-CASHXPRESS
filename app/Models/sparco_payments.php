<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sparco_payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'merchantReference',
        'reference',
        'amount',
        'currency',
        'feeAmount',
        'feePercentage',
        'transactionAmount',
        'customerMobileWallet',
        'customerFirstName',
        'customerLastName',
        'message',
        'status',
    ];
}

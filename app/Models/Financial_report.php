<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'year',
        'total_sales',
        'total_expanse',
        'profit_before_tax',
        'tax_amount',
        'profit_after_tax',
    ];
}

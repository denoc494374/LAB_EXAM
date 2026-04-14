<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'rice_id',
        'customer_name',
        'quantity',
        'price',
        'total_amount',
    ];

    public function rice()
    {
        return $this->belongsTo(Rice::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

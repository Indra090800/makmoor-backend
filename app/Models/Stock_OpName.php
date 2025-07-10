<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_OpName extends Model
{
    use HasFactory;
    protected $table = 'stock_opnames';

    protected $fillable = [
        'product_id',
        'system_stock',
        'physical_stock',
        'difference',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

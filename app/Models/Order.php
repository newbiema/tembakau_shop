<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');    
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'users_id', 'id');    
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['id', 'status', 'jumlah', 'total_harga', 'payment', 'user_id', 'product_id', 'bukti_transfer'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function cart()
    {
        return $this->belongsTo(Product::class, 'cart_id');
    }

   
}

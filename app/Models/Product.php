<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'name', 'picture', 'description', 'price', 'quantity'];

    public function Transaction()
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }
    public function Cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
}

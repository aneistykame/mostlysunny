<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    
    protected $primaryKey = 'cart_id'; 

    public $incrementing = true;

    protected $fillable = ['user_id'];

    // Relácia na položky v košíku
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }
}
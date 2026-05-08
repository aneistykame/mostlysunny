<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Polia, ktoré je možné hromadne priradiť (Mass Assignment).
     * Používame $guarded = [], čo znamená, že povoľujeme všetky polia,
     * ktoré pošleme cez $order->fill($request->all()).
     */
    protected $guarded = [];

    /**
     * Ak chceš mať vzťah na používateľa (ak je prihlásený).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ak by si mal tabuľku order_items (zoznam produktov v objednávke),
     * tu by bol vzťah. Pre základný prototyp nám stačí celková suma v tabuľke orders.
     */
    public function items()
    {
        // return $this->hasMany(OrderItem::class);
    }
}
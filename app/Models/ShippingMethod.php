<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    // Ak sa tvoja tabuľka volá shipping_methods, Laravel ju nájde automaticky.
    // Ale musíme definovať primárny kľúč:
    protected $primaryKey = 'shipping_id';

    // Ak v tabuľke nemáš stĺpce created_at a updated_at, pridaj toto:
    // public $timestamps = false;
}
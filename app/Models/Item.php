<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'description', 
        'quantity',
        'picture',
        'price',
        'is_active',
        'seller_id',
        'is_sold'
    ]; 


    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
    }
}

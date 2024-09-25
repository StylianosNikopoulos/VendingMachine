<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'productName','amountAvailable','cost','sellerId'];

    //Means that the product belongs to one user that is Seller
    public function seller(){
        return $this->belongsTo(User::class, 'sellerId');
    }
}
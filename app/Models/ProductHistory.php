<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'price',
        'description',
        'category',
        'quantity',
        'total',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function users(){
        // ในภาษา SQL => select * from ProductHistory inner join users ON product_history.user_id = users.id
        // Inner Join ID  ของ model user กับ column user_id ของ model นี้
        return $this->belongsTo('App\Models\User','user_id')->select(['id','firstName','lastName','image']);
    
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'tokenable_id',
        'created_at',
        'updated_at'
    ];

    public function activeUsers(){
        // ในภาษา SQL => select * from PersonalAccessToken inner join users ON personal_access_token.tokenable_id = users.id
         // Inner Join ID  ของ model user กับ column tokenable_id ของ model นี้
        // return $this->hasOne('App\Models\User','tokenable_id')
        return $this->belongsTo('App\Models\User','tokenable_id')->select(['id','firstName','lastName','email','image']);
     }
}

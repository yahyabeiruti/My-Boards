<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    protected $fillable =   ['name','color','discription','user_id'];

    /** @use HasFactory<\Database\Factories\BoardsFactory> */
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }
}

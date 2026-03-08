<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =   ['title',   'discription', 'priority',  'due_date', 'category', 'status', 'board_id'];
    /** @use HasFactory<\Database\Factories\AddTaskFactory> */
    use HasFactory;

    public function Board(){
        return $this->belongsTo(Boards::class);
    }
}

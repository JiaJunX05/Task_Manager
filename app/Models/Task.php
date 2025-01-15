<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'image',
        'title',
        'description',
        'due_date',
        'isCompleted',
        'user_id'
    ];

    // 指定due_date字段為日期格式
    protected $dates = ['due_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

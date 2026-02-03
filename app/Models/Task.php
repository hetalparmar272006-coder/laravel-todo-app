<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // ✅ Mass Assignment Protection
    protected $fillable = [
        'title',
        'user_id',
        'is_completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

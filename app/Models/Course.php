<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use HasFactory, Notifiable;

    // กำหนดตารางที่โมเดลนี้ใช้
    protected $table = 'courses';

    // กำหนดฟิลด์ที่สามารถกำหนดค่าได้โดยใช้ Mass Assignment
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'youtube_link',
        'user_id'
    ];

    /**
     * ความสัมพันธ์กับ User (Instructor)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
    
}

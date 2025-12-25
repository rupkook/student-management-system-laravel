<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'title',
        'description',
        'credit_hours',
        'level',
        'is_active',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
            ->withPivot('enrollment_date', 'status', 'grade', 'notes')
            ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function getEnrolledStudentsCountAttribute()
    {
        return $this->enrollments()->where('status', 'active')->count();
    }
}

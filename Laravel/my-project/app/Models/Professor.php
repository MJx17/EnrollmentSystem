<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'surname',
        'first_name',
        'middle_name',
        'sex',
        'contact_number',
        'email',
        'designation',
    ];

    // Relationships
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_professor');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

  // Professor.php
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }


    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->surname;
    }
}

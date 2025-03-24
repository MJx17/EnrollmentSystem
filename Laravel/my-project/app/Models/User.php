<?php


namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'username',    // Add 'username' field to fillable array
        'email',
        'password',
        'status',      // Add 'status' field to fillable array
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship with Student.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }
// User.php
        public function professor()
        {
            return $this->hasOne(Professor::class, 'user_id', 'id');
        }

}

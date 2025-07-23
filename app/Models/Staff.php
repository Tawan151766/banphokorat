<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'full_name',
        'phone',
        'role',
        'department',
        'img',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    // Role constants
    const ROLE_LEADER = 'leader';
    const ROLE_COLEADER = 'coleader';
    const ROLE_EMPLOYEE = 'employee';

    public static function getRoles()
    {
        return [
            self::ROLE_LEADER => 'หัวหน้า',
            self::ROLE_COLEADER => 'รองหัวหน้า',
            self::ROLE_EMPLOYEE => 'พนักงาน',
        ];
    }

    public function getRoleNameAttribute()
    {
        $roles = self::getRoles();
        return $roles[$this->role] ?? $this->role;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberClub extends Model
{
    protected $table = 'member_club'; // Set the table name if it's different from the default naming convention

    // Define the relationships, if any
    // For example, if a MemberClub belongs to a User and has a Role, you can define the relationships as follows:
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
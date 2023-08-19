<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function president()
    {
        return $this->belongsTo(User::class, 'president_id');
    }
    public function secretary()
    {
        return $this->belongsTo(User::class, 'secretary_id');
    }

    public function treasurer()
    {
        return $this->belongsTo(User::class, 'treasurer_id');
    }

}

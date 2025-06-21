<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
     protected $fillable = [
        'email',
        'role',
        'token',
        'company_id',
        'accepted',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiringDetails extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['team_name', 'role_name', 'candidate_name', 'joined_date'];
}

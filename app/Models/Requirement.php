<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Requirement extends Model
{
    //
    protected $fillable = ['id','team_name', 'role_name', 'requirement_count','status','hired_count'];
}

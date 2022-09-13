<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee","start", "end", "description", "project_lead_approved", "team_lead_approved", "status"
    ];
}

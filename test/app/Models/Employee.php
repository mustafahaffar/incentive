<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function targets()
    {
        return $this->belongsToMany(target::class , 'employee_target');
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class , 'employee_evaluation');
    }

    public function manegers()
    {
        return $this->belongsToMany(Maneger::class , 'employee_maneger');
    }

    public function works()
    {
        return $this->hasMany(Work::class , 'employee_id');
    }
}

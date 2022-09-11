<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public function getYearCreatedAtAttribute(){
        return $this->created_at->format('Y');
    }
}

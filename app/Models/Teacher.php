<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = [ 'first_name', 'middle_name', 'last_name', 'gender_id' ];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }
}

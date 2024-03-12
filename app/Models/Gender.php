<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    
    public $guarded = [];
    
    protected $table = 'genders';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name' ];
}

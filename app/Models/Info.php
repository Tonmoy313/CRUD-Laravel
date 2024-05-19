<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table = 'info_tbl';
    
    public $timestamps = ['created_at', null];
    protected $fillable=['name', 'email', 'password', 'image'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class new_user extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'user';
    protected $primaryKey  = 'user_id';
    public $timestamps = false;
}

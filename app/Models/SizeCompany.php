<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'id', 'description'];
    protected $guarded = ['created_at', 'update_at'];
    protected $table = 'size_companies';
    protected $dates = ['deleted_at'];         
}

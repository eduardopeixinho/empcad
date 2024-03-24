<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyTest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'id', 'name','status','cnpj','cnaes_id','legal_forms','dt_estabilishment'];
    protected $guarded = ['created_at', 'update_at'];
    protected $table = 'company_tests';
    protected $dates = ['deleted_at'];      
}

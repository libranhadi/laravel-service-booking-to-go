<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyList extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'cst_id',
        'fl_relation',
        'fl_name',
        'fl_dob',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, "cst_id", "cst_id");
    }
}

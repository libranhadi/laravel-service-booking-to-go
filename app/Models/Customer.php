<?php

namespace App\Models;

use App\Models\FamilyList;
use App\Models\Nationality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'cst_id';
    protected $fillable = [
        'cst_id',
        'nationality_id',
        'cst_name',
        'cst_dob',
        'cst_phoneNum',
        'cst_email'
    ];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, "nationality_id", 'nationality_id');
    }

    public function familyLists()
    {
        return $this->hasMany(FamilyList::class, 'cst_id', 'cst_id');
    }
}

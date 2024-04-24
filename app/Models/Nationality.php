<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nationalities';

    protected $fillable = [
        'nationality_name',
        'nationality_code',
    ];


    protected $appends = [
        "label",
    ];

    public function getLabelAttribute() 
    {
        return $this->nationality_name ." (". $this->nationality_code . ")";
    }
}

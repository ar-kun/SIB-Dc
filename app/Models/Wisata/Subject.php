<?php

namespace App\Models\Wisata;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function wisata()
    {
        return $this->hasMany(Wisata::class);
    }
}
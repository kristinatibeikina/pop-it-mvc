<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'address',
    ];
    protected static function booted()
    {
        static::created(function ($building) {
            $building->save();
        });
    }

    public $table = 'building';

}
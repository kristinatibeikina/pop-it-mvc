<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'S',
        'count',
        'building_id',
        'view_id',

    ];
    protected static function booted()
    {
        static::created(function ($room) {
            $room->save();
        });
    }


    protected $table = 'room';
}
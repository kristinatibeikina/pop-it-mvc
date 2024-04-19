<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
    ];


    public $table = 'view';



}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'filename',
        'filepath',
        'filetype',
        'filesize',
    ];


    public $table = 'view';



}
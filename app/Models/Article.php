<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    
    protected $keyType = 'string';
    public $incrementing = false;

   
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid(); // Generate a UUID
        });
    }

    
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'cat_id',
        'date',
        'created_by',
    ];
}

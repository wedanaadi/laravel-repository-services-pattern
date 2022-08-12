<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * fillable : field di table posts yang boleh diisi manual
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];
    /**
     * hidden : field created_at & updated_at akan disembunyikan
     *
     * @var array
     */
    protected $hidden = ['create_at', 'updated_at'];
}

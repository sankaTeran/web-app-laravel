<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'top_sub_heading',
        'heading',
        'bottom_sub_heading',
        'image_link',
        'more_info_link'
    ];
}

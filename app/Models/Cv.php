<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'label',
        'filename',
        'original_name',
        'extension',
        'file_size',
        'is_public',
        'sort_order'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'file_size' => 'integer'
    ];

    public function getDownloadUrlAttribute()
    {
        return route('cv.download.multi', $this->id);
    }
}

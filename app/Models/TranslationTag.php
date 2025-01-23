<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationTag extends Model
{
    protected $fillable = ['translation_id', 'tag'];

    public function translation()
    {
        return $this->belongsTo(Translation::class);
    }
}


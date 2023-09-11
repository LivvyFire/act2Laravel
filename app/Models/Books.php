<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'literary_genres_id',
        'title',
        'author',
        'year_of_publication',
        'image',
    ];
    public function literary_genres(): BelongsTo{
        return $this->belongsTo(LiteraryGenres::class);
    }
}

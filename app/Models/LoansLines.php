<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoansLines extends Model
{
    use HasFactory;
    protected $fillable = [
        'loans_id',
        'books-id',
    ];
    public function loans(): BelongsTo{
        return $this->belongsTo(Loans::class);
    }

    public function books(): BelongsTo{
        return $this->belongsTo(Books::class);
    }
}

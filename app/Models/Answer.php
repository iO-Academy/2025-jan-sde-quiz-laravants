<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    /** @use HasFactory<\Database\Factories\AnswerFactory> */
    use HasFactory;

    protected $hidden = ['question_id', 'created_at', 'updated_at'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}

<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'description',
        'name',
        'email',
        'type_id',
        'status_id',
    ];
    public function type()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function status()
    {
        return $this->belongsTo(QuestionStatus::class);
    }
}

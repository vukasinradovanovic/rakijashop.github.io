<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $fillable = [
        'name',
        'is_active'
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

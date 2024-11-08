<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question_text',
        'time_limit',
    ];

    protected $casts = [
        'time_limit' => 'integer',
    ];

    /**
     * Get the quiz that owns the question.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the options for the question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

	/**
	 * Get the correct option for the question.
	 */
	public function getCorrectOption(): Option
	{
		return $this->options()->where('is_correct', true)->first();
	}

	/**
	 * Get the previous question.
	 */
	public function previousQuestion(): Question | null
	{
		return $this->where('quiz_id', $this->quiz_id)
					->where('id', '<', $this->id)
					->orderBy('id', 'desc')
					->first();
	}

	/**
	 * Get the next question.
	 */
	public function nextQuestion(): Question | null
	{
		return $this->where('quiz_id', $this->quiz_id)
					->where('id', '>', $this->id)
					->orderBy('id', 'asc')
					->first();
	}
}

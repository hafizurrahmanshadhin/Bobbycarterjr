<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Option;
use App\Models\SurvayQuestion;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserResponse extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'user_id'            => 'integer',
            'task_id'            => 'integer',
            'answer_id'          => 'integer',
            'survay_question_id' => 'integer',
            'option_id'          => 'integer',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo {
        return $this->belongsTo(Task::class);
    }

    public function answer(): BelongsTo {
        return $this->belongsTo(Answer::class);
    }

    public function survayQuestion(): BelongsTo {
        return $this->belongsTo(SurvayQuestion::class);
    }

    public function option(): BelongsTo {
        return $this->belongsTo(Option::class);
    }
}

<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Module;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'module_id',
        'questions',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'module_id' => 'integer',
            'questions' => 'string',
            'status'    => 'string',
        ];
    }

    public function module(): BelongsTo {
        return $this->belongsTo(Module::class);
    }

    public function answer(): HasOne {
        return $this->hasOne(Answer::class);
    }

    public function userResponses(): HasMany {
        return $this->hasMany(UserResponse::class);
    }
}

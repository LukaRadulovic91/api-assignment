<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    public $guarded = ['id'];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tasks(): MorphToMany
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

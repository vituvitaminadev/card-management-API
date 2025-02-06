<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $holder_id
 * @property string $alias
 * @property string $status
 * @property int $balance
 * @property User $user
 * @property User $holder
 */
class Card extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'cards';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'user_id',
        'holder_id',
        'alias',
        'status',
        'balance'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'holder_id' => 'integer',
        'alias' => 'string',
        'status' => 'string',
        'balance' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function holder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'holder_id');
    }

    public function getHolder(): User
    {
        return $this->holder;
    }
}

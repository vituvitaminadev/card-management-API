<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\HasMany;
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
 * @property Collection $transactions
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
		'balance',
	];

	protected array $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'holder_id' => 'integer',
		'alias' => 'string',
		'status' => 'string',
		'balance' => 'integer',
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

	public function transactions(): HasMany
	{
		return $this->hasMany(Transaction::class);
	}

	public function getTransactions(): Collection
	{
		return $this->transactions;
	}
}

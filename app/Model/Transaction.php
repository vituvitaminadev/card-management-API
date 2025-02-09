<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $card_id
 * @property string $description
 * @property string $type
 * @property int $value
 * @property User $user
 * @property Card $card
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Transaction extends Model
{
	/**
	 * The table associated with the model.
	 */
	protected ?string $table = 'transactions';

	/**
	 * The attributes that are mass assignable.
	 */
	protected array $fillable = [
		'user_id',
		'card_id',
		'description',
		'type',
		'value',
	];

	/**
	 * The attributes that should be cast to native types.
	 */
	protected array $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'card_id' => 'integer',
		'value' => 'integer',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function getUser(): User
	{
		return $this->user;
	}

	public function card(): BelongsTo
	{
		return $this->belongsTo(Card::class);
	}

	public function getCard(): Card
	{
		return $this->card;
	}
}

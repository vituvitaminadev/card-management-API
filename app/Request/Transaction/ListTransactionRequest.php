<?php

namespace App\Request\Transaction;

use App\Enum\User\UserTypeEnum;
use App\Model\Transaction;
use App\Request\Abstract\ModelFormRequest;

class ListTransactionRequest extends ModelFormRequest
{
    protected string $defaultSortColumn = 'created_at';
    protected array $availableSortColumns = [
        'created_at',
        'type'
    ];

    protected function model(): string
    {
        return Transaction::class;
    }
    public function rules(): array
    {
        return [
            'user' => ['nullable', 'exists:users,id'],
            'card' => ['nullable', 'exists:cards,id'],
            'sortBy' => ['string', 'in:' . implode(',', $this->availableSortColumns)],
            'sortDirection' => ['string', 'in:asc,desc'],
        ];
    }

    public function applyFilters(): void
    {
        $this->filterByUser();
        $this->filterByCard();
    }

    public function filterByUser(): void
    {
        if ($this->getUser()->type !== UserTypeEnum::ADMIN->value) {
            $this->builder()->where('user_id', $this->getUser()->id);
            return;
        }

        $this->builder()->when($this->input('user'), function ($query) {
            $query->where('user_id', $this->input('user'));
        });
    }

    public function filterByCard(): void
    {
        $this->builder()->when($this->input('card'), function ($query) {
            $query->where('card_id', $this->input('card'));
        });
    }
}
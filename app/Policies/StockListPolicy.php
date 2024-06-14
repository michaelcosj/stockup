<?php

namespace App\Policies;

use App\Models\StockList;
use App\Models\User;
use Log;

class StockListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StockList $stockList): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StockList $stockList): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StockList $stockList): bool
    {
        Log::info([
            'user_id' => $user->id,
            'list_owner_id' => $stockList->user_id,
            'list_owner' => $stockList->owner,
        ]);

        return $stockList->owner()->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StockList $stockList): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StockList $stockList): bool
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // TODO: Implement
    }

    public function view(User $user, Invoice $invoice): bool
    {
        // TODO: Implement
    }

    public function create(User $user): bool
    {
        // TODO: Implement
    }

    public function update(User $user, Invoice $invoice): bool
    {
        // TODO: Implement
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        // TODO: Implement
    }
}

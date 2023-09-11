<?php

namespace App\Observers;

use App\Events\CustomerEvent;
use App\Models\Customer;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        event(new CustomerEvent($customer, 'create'));
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        event(new CustomerEvent($customer, 'update'));
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        event(new CustomerEvent($customer, 'deleted'));
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        event(new CustomerEvent($customer, 'restored'));
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        event(new CustomerEvent($customer, 'force delete'));
    }
}

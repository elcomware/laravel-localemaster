<?php

namespace Elcomware\LocaleMaster\Events;

use Illuminate\Foundation\Events\Dispatchable;

class LocaleCreating
{
    use Dispatchable;

    /**
     * The team owner.
     */
    public mixed $creator;

    /**
     * Create a new event instance.
     *
     * @param  mixed  $creator
     * @return void
     */
    public function __construct($creator)
    {
        $this->creator = $creator;
    }
}

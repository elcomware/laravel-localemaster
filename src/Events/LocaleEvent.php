<?php

namespace Elcomware\LocaleMaster\Events;

use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class LocaleEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The team instance.
     */
    public Locale $locale;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Locale $locale)
    {
        $this->locale = $locale;
    }
}

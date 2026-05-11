<?php

namespace NIQAHEditor\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestSubmitted
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  array  $data  The raw data from the editor.
     */
    public function __construct(
        public array $data
    ) {}
}

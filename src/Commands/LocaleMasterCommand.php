<?php

namespace Elcomware\LocaleMaster\Commands;

use Illuminate\Console\Command;

class LocaleMasterCommand extends Command
{
    public $signature = 'laravel-localemaster';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;

class FixExceptionCommand extends Command
{
    protected $signature = 'admin:fix_exception';

    protected $description = 'Fix Authentication handling exception';

    public function handle()
    {
        $this->call('admin:fix', ['--exception' => true]);
    }
}

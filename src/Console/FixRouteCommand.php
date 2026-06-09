<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;

class FixRouteCommand extends Command
{
    protected $signature = 'admin:fix_route';

    protected $description = 'Fix Web route';

    public function handle()
    {
        $this->call('admin:fix', ['--route' => true]);
    }
}

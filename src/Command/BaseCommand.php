<?php

namespace CraftCli\Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $method = method_exists($this, 'handle') ? 'handle' : 'fire';

        return $this->$method();
    }

    /**
     * Useful for supressing log messages
     * @param  callable $callback
     * @return void
     */
    protected function suppressOutput(callable $callback)
    {
        ob_start();

        call_user_func($callback);

        ob_end_clean();
    }
}

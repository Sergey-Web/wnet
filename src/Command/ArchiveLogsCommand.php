<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ArchiveLogsCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('command:test')
            ->setDescription('Test command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>OK</info>');

        return 0;
    }
}
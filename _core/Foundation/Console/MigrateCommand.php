<?php
namespace Atova\Eshoper\Foundation\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand  extends Command{

    protected function configure()
    {
        $this->setDescription('This command is used to create all of database tables ');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Migration successfull');
        return Command::SUCCESS;
    
    }

}
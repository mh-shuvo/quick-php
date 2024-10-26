<?php
namespace Atova\Eshoper\Foundation\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Atova\Eshoper\Foundation\Migrations;
class MigrateCommand  extends Command{

    protected function configure()
    {
        $this->setDescription('This command is used to create all of database tables ');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {   
        try{
            $migrations = new Migrations();
            $migrations->runMigrations();
        }catch(\Exception $exc){
            $output->writeln($exc->getMessage());
        }
        
        return Command::SUCCESS;
    
    }

}
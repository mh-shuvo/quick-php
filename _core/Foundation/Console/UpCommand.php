<?php
namespace Atova\Eshoper\Foundation\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpCommand  extends Command{

    protected function configure()
    {
        $this->setDescription('This is Test Generate Admin Command Class. ');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try{

            if(file_exists(__DIR__."/../../../storage/framework/maintainenance.php")){
                unlink(__DIR__."/../../../storage/framework/maintainenance.php");
                $output->writeln("Your project is now in live.");
            }

        }catch(\Exception $exc){
            $output->writeln($exc->getMessage());
        }
        
        return Command::SUCCESS;
    
    }

}
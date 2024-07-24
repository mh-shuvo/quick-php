<?php

namespace MhShuvo\QuickPhp\Core\Foundation\Console\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class MaintenanceDownCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Maintenance Mode ON. It means the system is going on maintenance mode.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sourcePath = __DIR__ . "/../../../../stubs/maintenance.php";
        $destinationPath = __DIR__ . "/../../../../storage/framework/maintenance.php";

        try{
            if(!file_exists($sourcePath)){
                throw new \Exception(sprintf(" %s file doesn't exists",$sourcePath));
            }

            $isCopied = copy($sourcePath,$destinationPath);
            
            if($isCopied){
                $output->writeln("<info>You system is now under maintenance.</info>");
            }

        }catch (\Exception $exception){
            $output->writeln("<error>".$exception->getMessage()."</error>");
        }

        return Command::SUCCESS;
    }
}
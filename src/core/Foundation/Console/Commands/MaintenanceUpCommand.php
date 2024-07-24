<?php

namespace MhShuvo\QuickPhp\Core\Foundation\Console\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class MaintenanceUpCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Maintenance Mode Off. It means the system is on live');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = __DIR__ . "/../../../../storage/framework/maintenance.php";

        try{
            if(file_exists($filePath)){
                throw new \Exception(sprintf(" %s file doesn't exists",$filePath));
                unlink($filePath);
                $output->writeln("<info>Your system now on live.</info>");
            }
            
        }catch (\Exception $exception){
            $output->writeln("<error>".$exception->getMessage()."</error>");
        }

        return Command::SUCCESS;
    }
}
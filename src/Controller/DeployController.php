<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeployController extends AbstractController
{

    #[Route(path: '/deploy', name: 'deploy')]
    public function index(KernelInterface $kernel): Response
    {
        $commands = [
            'git pull',
            'git status',
        ];
        
        $i = 0;
        $output = [];
        foreach($commands as $command){
            /* Run command */
            $tmp = shell_exec($command);
            /* Output */
            $output[$i]['command'] = $command; 
            $output[$i]['result'] = htmlentities(trim($tmp));
            $i++;
        }

        /* Clear cache */
        $command = 'cache:clear';
        $output[$i]['command'] = $command;
        $output[$i]['result'] = $this->do_command($kernel, [
            'command' => $command,
            '--env' => $kernel->getEnvironment()
        ]);

        $i++;
        /* Migration cache */
        $command = 'doctrine:migrations:migrate';
        $output[$i]['command'] = $command;
        $output[$i]['result'] = $this->do_command($kernel, [
            'command' => $command,
            '--no-interaction'
        ]);

        return $this->json([
            $output
        ]);
    }

    private function do_command(KernelInterface $kernel, array $command): string
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput($command);

        $output = new BufferedOutput();
        $application->run($input, $output);

        $content = $output->fetch();

        return $content;
    }
}

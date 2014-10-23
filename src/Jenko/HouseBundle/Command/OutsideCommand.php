<?php

namespace Jenko\HouseBundle\Command;

use Jenko\House\Aggregate\House;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class OutsideCommand extends ContainerAwareCommand
{
    /**
     * @var House
     */
    private $house;

    public function __construct()
    {
        parent::__construct();
        $this->house = House::buildHouse();
    }

    protected function configure()
    {
        $this
            ->setName('jenko:house:navigate')
            ->setDescription('Navigate the house')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Where would you like to go?',
            ['hallway'],
            0
        );
        $question->setErrorMessage('Location %s is invalid.');

        $location = $helper->ask($input, $output, $question);

        $enterRoomCommand = $this->getApplication()->find('jenko:house:enter-room');

        $arguments = array(
            'command' => 'jenko:house:enter-room',
            '--location' => $location,
        );

        $input = new ArrayInput($arguments);
        $enterRoomCommand->run($input, $output);
    }
} 
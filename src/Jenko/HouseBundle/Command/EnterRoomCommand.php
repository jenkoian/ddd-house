<?php

namespace Jenko\HouseBundle\Command;

use Jenko\House\Aggregate\House;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class EnterRoomCommand extends ContainerAwareCommand
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
            ->setName('jenko:house:enter-room')
            ->setDescription('Enter a room in the house')
            ->addOption('location', null, InputOption::VALUE_OPTIONAL, 'If set, the house will start from this room')
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
        $room = $input->getOption('location');
        $this->house->enterRoom($room);

        $command = new EnterRoomCommand();
        $command->room = $input->getOption('location');
        $house = $this->getContainer()->get('tabbi89_commander.command.default_command_bus')->execute($command);

        $output->writeln('You are in: ' . $room);

        $info = $house->whereAmI()->getInformation();

        $table = $this->getHelper('table');
        $table
            ->setHeaders(array('size', 'exits'))
            ->setRows(array(
                    array($info['size'], implode(", ", $info['rooms'])),
                ))
        ;
        $table->render($output);

        $info['rooms'][] = 'back outside';

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Where would you like to go?',
            $info['rooms'],
            0
        );
        $question->setErrorMessage('Location %s is invalid.');

        $location = $helper->ask($input, $output, $question);

        $nextCommandName = 'jenko:house:navigate';
        if ('back outside' !== $location) {
            $nextCommandName = 'jenko:house:enter-room';
            $args['--location'] = $location;
        }

        $nextCommand = $this->getApplication()->find($nextCommandName);
        $args['command'] = $nextCommand;

        $input = new ArrayInput($args);

        $nextCommand->run($input, $output);
    }
} 
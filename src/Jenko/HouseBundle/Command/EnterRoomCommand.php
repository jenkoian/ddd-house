<?php

namespace Jenko\HouseBundle\Command;

use Jenko\House\Aggregate\Dimensions;
use Jenko\House\Aggregate\Garden;
use Jenko\House\Aggregate\House;
use Jenko\House\Aggregate\Room;
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
        $kitchen = new Room('kitchen', new Dimensions(300, 100));
        $lounge = new Room('living-room', new Dimensions(400, 300));
        $hallway = new Room('hallway', new Dimensions(300, 800));
        $garden = new Garden('front garden', new Dimensions(600,80));
        $kitchen->setExits([$hallway]);
        $lounge->setExits([$kitchen]);
        $hallway->setExits([$lounge]);
        $garden->setExits([$hallway]);

        $locations =  [$lounge, $kitchen, $hallway, $garden];
        $this->house = House::buildHouse($locations);
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

        $command = new EnterRoomCommand();
        $command->room = $room;
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
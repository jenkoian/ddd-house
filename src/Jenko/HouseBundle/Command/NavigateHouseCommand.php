<?php

namespace Jenko\HouseBundle\Command;

use Jenko\House\Factory\HomeAloneHouseFactory;
use Jenko\House\House;
use Jenko\HouseCommandHandling\Command\EnterRoomCommand;
use SimpleBus\Command\Bus\CommandBus;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class NavigateHouseCommand extends ContainerAwareCommand
{
    /**
     * @var House $house
     */
    private $house;

    /**
     * @var CommandBus $commandBus
     */
    private $commandBus;

    public function __construct()
    {
        // Start outside
        $this->house = HomeAloneHouseFactory::getHouse('front-garden');

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('jenko:house:navigate')
            ->setDescription('Navigate the house')
            ->addOption('location', null, InputOption::VALUE_OPTIONAL, 'If set, the house will start from this room')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->commandBus = $this->getContainer()->get('command_bus');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $house = $this->house;
        $room = $input->getOption('location');

        if (null === $room) {
            $room = $this->house->whereAmI();
        }

        $command = new EnterRoomCommand();
        $command->house = $house;
        $command->room = $room;

        $this->commandBus->handle($command);

        $output->writeln('You are in: ' . $room);

        $info = $house->whereAmI()->getInformation();

        $table = $this->getHelper('table');
        $table
            ->setHeaders(array('dimensions', 'exits'))
            ->setRows(array(
                array($info['dimensions'], implode(", ", $info['exits'])),
            ))
        ;
        $table->render($output);

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Where would you like to go?',
            $info['exits'],
            0
        );
        $question->setErrorMessage('Location %s is invalid.');

        $location = $helper->ask($input, $output, $question);

        $nextCommandName = 'jenko:house:navigate';
        $args['--location'] = $location;

        $nextCommand = $this->getApplication()->find($nextCommandName);
        $args['command'] = $nextCommand;

        $input = new ArrayInput($args);

        $nextCommand->run($input, $output);
    }
}

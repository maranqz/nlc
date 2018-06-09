<?php
/**
 * Date: 09.06.2018
 * Time: 16:47
 */

namespace DLP\commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MSSR extends Command
{
	protected function configure()
	{
		parent::configure();

		$this->setName('mssr')
			->setDescription('Show matrix semantic-syntactic representation for sentence')
			->addArgument('sentence', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{

	}
}
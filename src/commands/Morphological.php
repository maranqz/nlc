<?php

namespace DLP\commands;

use DLP\components\Preparing;
use DLP\components\Render;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Morphological extends Command
{
	protected function configure()
	{
		parent::configure();

		$this->setName('morphological')
			->setDescription('Show morphological analysis for word')
			->addArgument('sentence', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$words = Preparing::getWords($input->getArgument('sentence'));

		$morphy = \DLP\analysis\Morphological::getInstance();

		$rows = $morphy->getWordsRows($words);

		Render::table($output, $rows, $morphy->getHeaders());
	}
}
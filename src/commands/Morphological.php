<?php

namespace DLP\commands;

use DLP\components\Render;
use Symfony\Component\Console\Command\Command;
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
			->addArgument('word', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$word = mb_strtoupper($input->getArgument('word'));

		$morphy = \DLP\analysis\Morphological::getInstance();
		$rows = $morphy->getTable($word, true);

		Render::table($output, $rows, $morphy->getHeaders());
	}
}
<?php
/**
 * Date: 09.06.2018
 * Time: 16:47
 */

namespace DLP\commands;


use DLP\components\Preparing;
use DLP\components\Render;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClassificationCommand extends Command
{
	protected function configure()
	{
		parent::configure();

		$this->setName('classification')
			->setDescription('Классифицирующее представление')
			->addArgument('sentence', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$words = Preparing::getWords($input->getArgument('sentence'));
		$morphy = \DLP\analysis\Morphological::getInstance();

		$usedWords = [];
		$rows = [];

		$mcoord = 1;
		foreach ($words as $word) {
			if (empty($usedWords[$word])) {
				$usedWords[$word] = $mcoord;
				$mcoord++;
			}

			$rows[] = [
				$word,
				$morphy->getPartOfSpeech($word),
				$usedWords[$word],
			];
		}

		Render::table($output, $rows, ['unit', 'tclass', 'mcoord']);
	}
}
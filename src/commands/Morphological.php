<?php

namespace DLP\commands;

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

		$this->setName('morphological')->addArgument('word', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$rows = [];
		$word = mb_strtoupper($input->getArgument('word'));
		$morphy = \DLP\analysis\Morphological::getInstance();

		/** @var \phpMorphy_WordDescriptor_Collection $paradigms */
		$paradigms = $morphy->getMorphy()->findWord($word);

		foreach ($paradigms as $paradigm) {
			/** @var \phpMorphy_WordDescriptor $paradigm */

			$baseForm = $paradigm->getBaseForm();

			$found_word_ary = $paradigm->getFoundWordForm();
			foreach ($found_word_ary as $found_form) {
				/** @var \phpMorphy_WordForm $found_form */
				$rows[] = [
					$baseForm,
					$found_form->getPartOfSpeech(),
					implode(',', $found_form->getGrammems())
				];
			}

			$rows[] = new TableSeparator();
		}

		unset($rows[count($rows) - 1]);

		Render::table($output, $rows, $morphy->getHeaders());
	}
}
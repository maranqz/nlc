<?php

namespace DLP\commands\dictionary;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveCommand extends DictionaryCommand
{
	public static function getDefaultName()
	{
		return 'dictionary:remove';
	}

	protected function configure()
	{
		parent::configure();
		$this
			->setDescription('Удаляет элемент в выбранном словаре.')
			->addOption('i', null, InputOption::VALUE_REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		parent::execute($input, $output);

		$this->dictionary->remove($input->getOption('i'));
	}
}
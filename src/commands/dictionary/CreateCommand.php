<?php

namespace DLP\commands\dictionary;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends DictionaryCommand
{
	protected $optionsByProperties = true;

	public static function getDefaultName()
	{
		return 'dictionary:create';
	}

	protected function configure()
	{
		parent::configure();
		$this->setDescription('Создает новый элемент в выбранном словаре.')
			->addOption('index', null, InputOption::VALUE_REQUIRED, 'Index of element');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		parent::execute($input, $output);

		$dicItemProperties = $this->dictionary->getItemProperties();

		$properties = [];
		foreach ($dicItemProperties as $property) {
			$properties[$property] = $input->getOption($property);
		}

		$this->dictionary->create($properties);
	}
}
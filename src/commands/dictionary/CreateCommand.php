<?php

namespace DLP\commands\dictionary;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends DictionaryCommand
{
	protected $optionsByProperties = [
		'index' => true
	];

	public static function getDefaultName()
	{
		return 'dictionary:create';
	}

	protected function configure()
	{
		parent::configure();
		$this->setDescription('Создает новый элемент в выбранном словаре.');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		parent::execute($input, $output);

		$dicItemProperties = $this->dictionary->getItemProperties(true);

		$properties = [];
		foreach ($dicItemProperties as $property) {
			$properties[$property] = $input->getOption($property);
		}

		$this->dictionary->create($properties);
	}
}
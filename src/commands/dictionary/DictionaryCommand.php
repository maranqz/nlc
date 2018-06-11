<?php

namespace DLP\commands\dictionary;

use DLP\dictionaries\Dictionary;
use DLP\dictionaries\LsDictionary;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class DictionaryCommand extends Command
{
	/** @var Dictionary[] */
	const DICTIONARIES = [
		'LsDic' => LsDictionary::class
	];

	/** @var Dictionary */
	protected $dictionary;

	protected $optionsByProperties = false;

	public function __construct($name = null)
	{
		list(, , $dictionaryName) = explode(':', $name);

		if (empty(self::DICTIONARIES[$dictionaryName])) {
			throw new \InvalidArgumentException('Dictionary "' . $dictionaryName . '" is not exist.');
		}

		/** @var Dictionary $dictionary */
		$dictionaryClassName = self::DICTIONARIES[$dictionaryName];
		$this->dictionary = $dictionaryClassName::getInstance();

		parent::__construct($name);
	}

	private function addOptionsByProperties()
	{
		if (!empty($this->optionsByProperties)) {
			$options = $this->optionsByProperties;
		} else {
			$options = [
				'index' => false,
			];
		}
		$dicItemProperties = $this->dictionary->getItemProperties($options);

		foreach ($dicItemProperties as $dicItemProperty) {
			if (!$this->getDefinition()->hasOption($dicItemProperty)) {
				$this->addOption($dicItemProperty, null, InputOption::VALUE_OPTIONAL, '');
			}
		}
	}

	protected function configure()
	{
		if ($this->optionsByProperties) {
			$this->addOptionsByProperties();
		}
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
	}
}
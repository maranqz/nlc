<?php

namespace DLP\commands\dictionary;


use DLP\components\Render;
use DLP\dictionaries\Dictionary;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectionCommand extends DictionaryCommand
{
	public static function getDefaultName()
	{
		return 'dictionary:projection';
	}

	protected function configure()
	{
		parent::configure();
		$this
			->setDescription('Показывает проекцию текста.')
			->addArgument('sentence', InputOption::VALUE_REQUIRED, 'Index of element');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		parent::execute($input, $output);
		
		$rows = $this->dictionary->projections($input->getArgument('sentence'));

		if (!empty($rows)) {
			$header = array_keys($rows[0]);

			Render::table($output, $rows, $header);
		} else {
			$output->writeln('Проекция не может быть построена');
		}
	}
}
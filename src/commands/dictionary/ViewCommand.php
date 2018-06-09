<?php

namespace DLP\commands\dictionary;


use DLP\dictionaries\Dictionary;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ViewCommand extends DictionaryCommand
{
	public static function getDefaultName()
	{
		return 'dictionary:view';
	}

	protected function configure()
	{
		parent::configure();
		$this
			->setDescription('Показывает элементы в выбранном словаре.')
			->addOption('index', null, InputOption::VALUE_OPTIONAL, 'Index of element');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		parent::execute($input, $output);

		if ($index = $input->getOption('index')) {
			if (empty($this->dictionary[$index])) {
				throw new \InvalidArgumentException('The index "' . $index . '" is not exist');
			}

			$rows = [$this->dictionary[$index]->writeLn()];
		} else {
			$rows = $this->dictionary->writeLn();
		}

		$this->renderTable($output, $rows);
	}

	protected function renderTable(OutputInterface $output, $rows)
	{
		$table = new Table($output);

		$table->setHeaders($this->dictionary->firstLine())
			->setRows($rows);
		$table->render();
	}
}
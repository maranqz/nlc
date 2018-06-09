<?php

namespace DLP\components;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class Render
{
	private function __construct()
	{
	}

	public static function table(OutputInterface $output, $rows, $header = false)
	{
		$table = new Table($output);

		if ($header && is_array($header)) {
			$table->setHeaders($header);
		}
		$table->setRows($rows);
		$table->render();
	}
}
<?php

namespace DLP\analysis;


use DLP\components\exceptions\WordNotFound;
use DLP\components\Morphy;
use DLP\components\Singleton;

class Morphological
{
	use Singleton;

	protected $v8;
	/** @var Morphy */
	protected $morphy;

	private function __construct()
	{
		$this->morphy = Morphy::getInstance();
	}

	public function getHeaders(){
		return [
			'НФ',
			'ЧР',
			'Грамматика',
		];
	}

	public function getMorphy()
	{
		return $this->morphy;
	}

	public function getGramInfo($word, $one = true)
	{
		$result = $this->morphy->getGramInfo($word);

		if (empty($result)) {
			throw new WordNotFound('The word "' . $word . '" is not found.');
		}

		if ($one) {
			$result = $result[0];
		}

		return $result;
	}
}
<?php

namespace DLP\analysis;


use DLP\components\exceptions\WordNotFound;
use DLP\components\Morphy;
use DLP\components\Singleton;
use Symfony\Component\Console\Helper\TableSeparator;

class Morphological
{
	use Singleton;

	protected $v8;
	/** @var Morphy */
	protected $morphy;

	private function __construct()
	{
		$this->morphy = new Morphy();
	}

	public function getHeaders()
	{
		return [
			'Поз',
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

	public function getPartOfSpeech($word, $one = true)
	{
		$result = $this->morphy->getPartOfSpeech($word);

		if (empty($result)) {
			throw new WordNotFound('The word "' . $word . '" is not found.');
		}

		if ($one) {
			$result = $result[0];
		}

		return $result;
	}

	public function getWordRows($word, $isSeparator = false)
	{
		$rows = [];

		/** @var \phpMorphy_WordDescriptor_Collection $paradigms */
		$paradigms = $this->getMorphy()->findWord($word);

		foreach ($paradigms as $paradigm) {
			/** @var \phpMorphy_WordDescriptor $paradigm */
			$baseForm = $paradigm->getBaseForm();
			$found_word_ary = $paradigm->getFoundWordForm();

			if ($isSeparator) {
				$items = &$rows;
			} else {
				$items = [];
			}

			foreach ($found_word_ary as $found_form) {
				/** @var \phpMorphy_WordForm $found_form */
				$items[] = [
					$baseForm,
					$found_form->getPartOfSpeech(),
					implode(',', $found_form->getGrammems())
				];
			}

			if ($isSeparator) {
				$rows[] = new TableSeparator();
			} else {
				$rows[$baseForm] = $items;
			}
		}

		if ($isSeparator) {
			unset($rows[count($rows) - 1]);
		}

		return $rows;
	}

	public function getWordsRows($words)
	{
		$rows = [];

		$pos = 1;
		foreach ($words as $word) {
			$items = $this->getWordRows($word, true);

			foreach ($items as $item) {
				if (!is_array($item)) {
					continue;
				}
				array_unshift($item, $pos);
				$rows[] = $item;
			}
			$pos++;
			$rows[] = new TableSeparator();
			$rows[] = new TableSeparator();
		}

		$last = count($rows) - 1;
		unset($rows[$last--], $rows[$last]);

		return $rows;
	}
}
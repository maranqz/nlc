<?php

namespace DLP\dictionaries;

use DLP\analysis\Morphological;
use DLP\components\exceptions\WordNotFound;
use DLP\components\Morphy;


/**
 * Class LsDictionary
 *
 * @method LsItem offsetGet()
 */
class LsDictionary extends Dictionary
{
	protected function dataFile()
	{
		return "LsDic.json";
	}

	protected function itemClass()
	{
		return LsItem::class;
	}

	public function projections($sentence)
	{
		$result = [];

		$words = explode(' ', $sentence);

		print_r($words);

		$index = 1;
		foreach ($words as $word) {
			$items = $this->projection($word);

			foreach ($items as $item) {
				$item = ['N' => $index] + $item;

				unset($item['lec'], $item['pt']);

				$result[] = $item;
				$index++;
			}
		}

		return $result;
	}

	/**
	 * @param $word
	 * @return array
	 */
	public function projection($word)
	{
		$lemmatize = Morphological::getInstance()->getMorphy()->lemmatize(mb_strtoupper($word));

		if (empty($lemmatize)) {
			throw new WordNotFound('The word "' . $word . '" is not found');
		}
		$lemmatize = mb_strtolower($lemmatize[0]);

		$result = [];
		/** @var DictionaryItem[] $items */
		$items = $this->getByHash($lemmatize);

		foreach ($items as $item) {
			$item = $item->asArray();
			unset($item['index']);


			$result[] = $item;
		}

		return $result;
	}
}


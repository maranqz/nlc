<?php

namespace DLP\dictionaries;


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

	public function firstLine()
	{
		return [
			'i',
			'lec',
			'pt',
			'sem',
			'st1',
			'st2',
			'st3',
			'comment'
		];
	}
}


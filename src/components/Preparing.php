<?php

namespace DLP\components;


class Preparing
{
	private function __construct()
	{
	}

	public static function getWords($sentence)
	{
		$result = [];
		$words = explode(' ', $sentence);

		foreach ($words as $word) {
			$result[] = mb_strtoupper($word);
		}

		return $result;
	}
}
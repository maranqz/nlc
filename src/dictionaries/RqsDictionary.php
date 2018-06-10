<?php

namespace DLP\dictionaries;


/**
 * Class RqsDictionary
 *
 * @method RqsItem offsetGet()
 */
class RqsDictionary extends Dictionary
{
	protected function dataFile()
	{
		return "RqsDic.json";
	}

	protected function itemClass()
	{
		return RqsItem::class;
	}


}


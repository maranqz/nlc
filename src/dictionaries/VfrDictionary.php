<?php

namespace DLP\dictionaries;


/**
 * Class VfrDictionary
 *
 * @method VfrItem offsetGet()
 */
class VfrDictionary extends Dictionary
{
	protected function dataFile()
	{
		return "VfrDic.json";
	}

	protected function itemClass()
	{
		return VfrItem::class;
	}


}


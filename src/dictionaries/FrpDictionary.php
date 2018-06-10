<?php

namespace DLP\dictionaries;


/**
 * Class FrpDictionary
 *
 * @method FrpItem offsetGet()
 */
class FrpDictionary extends Dictionary
{
	protected function dataFile()
	{
		return "FrpDic.json";
	}

	protected function itemClass()
	{
		return FrpItem::class;
	}


}


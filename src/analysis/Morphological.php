<?php

namespace DLP\analysis;


use DLP\components\Singleton;

class Morphological
{
	use Singleton;

	protected $v8;

	private function __construct()
	{
		$this->v8 = new \V8Js();
	}
}
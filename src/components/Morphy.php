<?php

namespace DLP\components;


class Morphy extends \cijic\phpMorphy\Morphy
{
	use Singleton;

	public function __construct($language = 'ru')
	{
		parent::__construct($language);
	}
}
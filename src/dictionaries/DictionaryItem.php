<?php

namespace DLP\dictionaries;

use DLP\components\Validation;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class DictionaryItem
 */
class DictionaryItem
{
	public static function properties()
	{
		return [
			'index'
		];
	}

	/**
	 * @var integer
	 *
	 * @Assert\NotBlank()
	 * @Assert\Range(
	 *      min = 1
	 * )
	 */
	public $index;

	public function writeLn()
	{
		$result = [];
		foreach (static::properties() as $property) {
			$result[$property] = $this->$property;
		}

		return $result;
	}

	public function validation()
	{
		if (($errors = Validation::getInstance()->validate($this)) && count($errors) > 0) {
			throw new ValidatorException((string)$errors);
		}
	}
}

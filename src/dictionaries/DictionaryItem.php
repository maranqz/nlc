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
		return array_values(get_object_vars($this));
	}

	public function validation()
	{
		if (($errors = Validation::getInstance()->validate($this)) && count($errors) > 0) {
			throw new ValidatorException((string)$errors);
		}
	}
}

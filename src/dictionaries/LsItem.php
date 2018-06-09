<?php

namespace DLP\dictionaries;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class LsItem
 */
class LsItem extends DictionaryItem
{
	public static function properties()
	{
		$properties = parent::properties();

		$properties[] = 'lec';
		$properties[] = 'pt';
		$properties[] = 'sem';
		$properties[] = 'st1';
		$properties[] = 'st2';
		$properties[] = 'st3';
		$properties[] = 'comment';

		return $properties;
	}

	/**
	 * @var string
	 * @Assert\NotBlank()
	 */
	public $lec;
	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 1,
	 *      max = 100
	 * )
	 */
	public $pt;
	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 1,
	 *      max = 100
	 * )
	 *
	 * Intens - P[1] интенсиональный квантор
	 * Rel - P[4]
	 */
	public $sem;
	/** @var string */
	public $st1;
	/** @var string */
	public $st2;
	/** @var string */
	public $st3;
	/** @var string */
	public $comment;
}

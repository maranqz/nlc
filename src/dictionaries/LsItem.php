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

		$properties[] = 'lexeme';
		$properties[] = 'partCase';
		$properties[] = 'sem';
		$properties[] = 'semanticCoordinate1';
		$properties[] = 'semanticCoordinate2';
		$properties[] = 'semanticCoordinate3';
		$properties[] = 'comment';

		return $properties;
	}

	/**
	 * @var string
	 * @Assert\NotBlank()
	 */
	public $lexeme;
	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 1,
	 *      max = 100
	 * )
	 */
	public $partCase;
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
	public $semanticCoordinate1;
	/** @var string */
	public $semanticCoordinate2;
	/** @var string */
	public $semanticCoordinate3;
	/** @var string */
	public $comment;
}

<?php

namespace DLP\dictionaries;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FrpItem
 */
class FrpItem extends DictionaryItem
{
	public static function properties()
	{
		$properties = parent::properties();

		$properties[] = 'prep';
		$properties[] = 'sr1';
		$properties[] = 'sr2';
		$properties[] = 'grc';
		$properties[] = 'rel';
		$properties[] = 'ex';


		return $properties;
	}

	/**
	 * @var string
	 * @Assert\NotBlank()
	 */
	public $prep;
    /**
     * @var string
     * @Assert\Type("string")
     */
	public $sr1;
    /**
     * @var string
     * @Assert\NotBlank()
     */
	public $sr2;
    /**
     * @var string
     * @Assert\NotBlank()
     */
	public $grc;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 6
     * )
     */
	public $rel;
    /**
     * @var string
     * @Assert\Type("string")
     */
	public $ex;
    /**
     * @var string
     * @Assert\Type("string")
     */

	public $comment;
}

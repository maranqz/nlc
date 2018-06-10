<?php

namespace DLP\dictionaries;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RqsItem
 */
class RqsItem extends DictionaryItem
{
	public static function properties()
	{
		$properties = parent::properties();

		$properties[] = 'prep';
		$properties[] = 'qw';
		$properties[] = 'relq';


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
	public $qw;
    /**
     * @var string
     * @Assert\NotBlank()
     */
	public $relq;
    /**
     * @var string
     * @Assert\NotBlank()
     */

	public $comment;
}

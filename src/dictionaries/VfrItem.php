<?php

namespace DLP\dictionaries;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VfrItem
 */
class VfrItem extends DictionaryItem
{
	public static function properties()
	{
		$properties = parent::properties();

		$properties[] = 'semsit';
		$properties[] = 'form';
		$properties[] = 'refl';
		$properties[] = 'vc';
		$properties[] = 'sprep';
		$properties[] = 'grcase';
		$properties[] = 'str';
        $properties[] = 'trole';
        $properties[] = 'expl';

		return $properties;
	}

	/**
	 * @var string
	 * @Assert\NotBlank()
	 */
	public $semsit;
	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 1,
	 *      max = 100
	 * )
	 */
	public $form;
    /**
     * @var string
     * @Assert\Type("string")
     */
	public $refl;
    /**
     * @var string
     * @Assert\Type("string")
     */
	public $vc;
    /**
     * @var string
     * @Assert\Type("string")
     */
	public $sprep;
    /**
     * @var string
     * @Assert\Type("string")
     */
	public $grcase;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 0,
     *      max = 6
     * )
     */
    public $str;
    /** @var string
     * @Assert\NotBlank()
     */
    public $trole;
    /** @var string
     * @Assert\NotBlank()
     */
    public $expl;
    /** @var string */
	public $comment;
}

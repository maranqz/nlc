<?php

namespace DLP\components;


use Symfony\Component\Validator\Validation as BaseValidation;

class Validation
{
	use Singleton;

	protected $validation;

	protected function __construct()
	{
		$this->validation = BaseValidation::createValidatorBuilder()
			->enableAnnotationMapping()
			->getValidator();
	}

	public function validate($value, $constraints = null, $groups = null)
	{
		return $this->validation->validate($value, $constraints, $groups);
	}
}
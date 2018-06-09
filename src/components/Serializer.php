<?php

namespace DLP\components;


use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer as BaseSerializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Serializer extends BaseSerializer
{
	use Singleton;

	public function __construct()
	{
		$encoders = [
			new JsonEncoder(new JsonEncode(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))
		];
		$normalizers = [
			new ObjectNormalizer(),
			new ArrayDenormalizer(),
		];
		parent::__construct($normalizers, $encoders);
	}

	public static function getInstance()
	{
		return
			self::$instance === null
				? self::$instance = new static()//new self()
				: self::$instance;
	}
}
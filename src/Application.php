<?php

namespace DLP;


class Application extends \Symfony\Component\Console\Application
{
	const BASEDIR = __DIR__,
		DATA = self::BASEDIR . DIRECTORY_SEPARATOR . 'data';
}
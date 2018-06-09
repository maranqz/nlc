#!/usr/bin/env php
<?php

use DLP\commands\dictionary\CreateCommand;
use DLP\commands\dictionary\RemoveCommand;
use DLP\commands\dictionary\ViewCommand;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$app = new Application();

$commands = [];

foreach (\DLP\commands\dictionary\DictionaryCommand::DICTIONARIES as $command => $class) {
	$commands[] = new CreateCommand(CreateCommand::getDefaultName() . ':' . $command);
	$commands[] = new RemoveCommand(RemoveCommand::getDefaultName() . ':' . $command);
	$commands[] = new ViewCommand(ViewCommand::getDefaultName() . ':' . $command);
}

$app->addCommands($commands);

$app->run();
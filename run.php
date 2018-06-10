#!/usr/bin/env php
<?php

use \DLP\commands\Morphological;
use DLP\commands\dictionary\CreateCommand;
use DLP\commands\dictionary\RemoveCommand;
use DLP\commands\dictionary\ViewCommand;
use DLP\commands\dictionary\ProjectionCommand;
use Symfony\Component\Console\Application;
use Doctrine\Common\Annotations\AnnotationRegistry;
use \DLP\commands\ClassificationCommand;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require_once __DIR__ . '/vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$app = new Application();

$commands = [
	new Morphological(),
	new ClassificationCommand()
];

foreach (\DLP\commands\dictionary\DictionaryCommand::DICTIONARIES as $command => $class) {
	$commands[] = new CreateCommand(CreateCommand::getDefaultName() . ':' . $command);
	$commands[] = new RemoveCommand(RemoveCommand::getDefaultName() . ':' . $command);
	$commands[] = new ViewCommand(ViewCommand::getDefaultName() . ':' . $command);
	$commands[] = new ProjectionCommand(ProjectionCommand::getDefaultName() . ':' . $command);
}

$app->addCommands($commands);

$app->run();
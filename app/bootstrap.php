<?php

// Load Nette Framework or autoloader generated by Composer
require __DIR__ . '/../libs/autoload.php';


$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
//$configurator->setDebugMode(TRUE);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../libs')
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon', $configurator::NONE); // none section

$configurator->onCompile[] = function ($configurator, $compiler) {
    $compiler->addExtension('events', new Kdyby\Events\DI\EventsExtension);
};

$container = $configurator->createContainer();

return $container;

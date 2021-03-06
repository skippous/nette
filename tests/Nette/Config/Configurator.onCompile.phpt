<?php

/**
 * Test: Nette\Config\Configurator and user extension.
 *
 * @author     David Grudl
 * @package    Nette\Config
 */

use Nette\Config\Configurator;



require __DIR__ . '/../bootstrap.php';



class DatabaseExtension extends Nette\Config\CompilerExtension
{
}



$configurator = new Configurator;
$configurator->setTempDirectory(TEMP_DIR);
$configurator->onCompile[] = function(Configurator $configurator, Nette\Config\Compiler $compiler) {
	$compiler->addExtension('database', new DatabaseExtension);
};
$container = $configurator->addConfig('files/compiler.extension.neon')
	->createContainer();

Assert::true( $container->getService('database.foo') instanceof stdClass );

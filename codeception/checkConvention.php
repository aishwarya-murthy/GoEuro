#!/usr/bin/env php
<?php

/**
 * Checks .acte-* convention
 *
 * PHP version 5
 *
 * @category  Tools
 * @package   AcceptanceTests
 * @author    aleksandr.bogdanov <aleksandr.bogdanov@home24.de>
 * @copyright 2014 Home24 GmbH
 * @license   Proprietary license
 * @link      http://www.home24.de
 */
namespace Fpc\Shop\Tests\Acceptance\CheckConvention;

require_once __DIR__.'/vendor/autoload.php';
set_error_handler(function($code, $error, $file = null, $line = null)
{
    $severe = (int) $code < E_PARSE;
    if (error_reporting() & $code) {
        // This error is not suppressed by current error reporting settings
        // Convert the error into an ErrorException
        throw new \ErrorException($error, $code, $severe, $file, $line);
    }

    // Do not execute the PHP error handler
    return true;
}, E_ALL);

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use \commons\Command\CheckConvention;

/**
 * Checks .acte-* convention
 *
 * @category  Tools
 * @package   AcceptanceTests
 * @author    aleksandr.bogdanov <aleksandr.bogdanov@home24.de>
 * @copyright 2014 Home24 GmbH
 * @license   Proprietary license
 * @link      http://www.home24.de
 */
class App extends Application
{
    /**
     * Gets the name of the command based on input.
     *
     * @param InputInterface $input The input interface
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input)
    {
        // This should return the name of your command.
        return 'checkConvention';
    }

    /**
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new CheckConvention();

        return $defaultCommands;
    }

    /**
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     *
     * @return \Symfony\Component\Console\Input\InputDefinition
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        $args = $inputDefinition->getArguments();
        array_shift($args);
        $inputDefinition->setArguments($args);

        return $inputDefinition;
    }
}

$application = new App();
$application->run();
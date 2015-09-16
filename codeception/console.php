#!/usr/bin/env php
<?php
/**
 * Tests console
 *
 * PHP version 5
 *
 * @category  Tools
 * @package   Tests
 * @author    Michal Sordyl <michal.sordyl@codete.co>
 * @copyright 2015 Home24 GmbH
 * @license   Proprietary license
 * @link      http://www.home24.de
 */
namespace Fpc\Shop\Tests\UserManager;

require_once __DIR__ . '/vendor/autoload.php';
set_error_handler(function ($code, $error, $file = null, $line = null) {
    $severe = (int) $code < E_PARSE;
    if (error_reporting() & $code) {
        throw new \ErrorException($error, $code, $severe, $file, $line);
    }
    return true;
}, E_ALL);

use commons\Command\ProductManager\SetSimpleQuantity;
use \commons\Command\UserManager\AddUsers;
use \commons\Command\UserManager\RemoveUsers;
use commons\Command\UserManager\GetUser;
use commons\Command\UserManager\ListUsers;
use commons\Command\UserManager\ReleaseUser;
use \Symfony\Component\Console\Application;

/**
 * Tests console
 *
 * @category  Tools
 * @package   Tests
 * @author    Michal Sordyl <michal.sordyl@codete.co>
 * @copyright 2015 Home24 GmbH
 * @license   Proprietary license
 * @link      http://www.home24.de
 */
class App extends Application
{

    /**
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new AddUsers();
        $defaultCommands[] = new RemoveUsers();
        $defaultCommands[] = new ListUsers();
        $defaultCommands[] = new GetUser();
        $defaultCommands[] = new ReleaseUser();
        $defaultCommands[] = new SetSimpleQuantity();

        return $defaultCommands;
    }
}

$application = new App();
$application->run();
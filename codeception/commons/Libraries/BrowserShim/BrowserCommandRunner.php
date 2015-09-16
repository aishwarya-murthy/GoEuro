<?php
/**
 * Runner for BrowserShim inner module
 *
 * PHP version 5
 *
 * @category  AcceptanceTests
 * @package   Fpc\Shop\Tests\Acceptance
 * @author    Sławomir Jabłeka <slawomir.jableka@codete.co>
 * @copyright 2014 Home24 GmbH
 * @license   Proprietary license
 * @link      http://www.home24.de
 */

namespace commons\Libraries\BrowserShim;

use Codeception\Module;
use Codeception\Module\PhpBrowser;
use Codeception\Module\WebDriver;

/**
 * Runner for BrowserShim inner module
 *
 * @category  AcceptanceTests
 * @package   Fpc\Shop\Tests\Acceptance
 * @author    Sławomir Jabłeka <slawomir.jableka@codete.co>
 * @copyright 2015 Home24 GmbH
 * @license   Proprietary license
 * @link      http://www.home24.de
 *
 * @mixin PhpBrowser
 * @mixin WebDriver
 */
class BrowserCommandRunner
{
    protected $module;
    protected $callTries = 10;
    protected $sleepTime = 1000000;

    /**
     * Constructor
     *
     * @param Module $module Browser module
     *
     * @return self
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Calls inner module method and retries if StaleElementReferenceException is thrown
     *
     * @param string $name      method name
     * @param array  $arguments method arguments
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $tries = $this->callTries;
        do {
            --$tries;
            try {
                return call_user_func_array(array($this->module, $name), $arguments);
            } catch (\StaleElementReferenceException $e) {
                if ($tries <= 0) {
                    throw $e;
                }
            }
            usleep($this->sleepTime);
        } while ($tries > 0);

        return null;
    }
}

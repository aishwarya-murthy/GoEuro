<?php
/**
 * cli config
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
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$userManager   = new \commons\Libraries\UserManager\UserManager(null);
$entityManager = $userManager->GetEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

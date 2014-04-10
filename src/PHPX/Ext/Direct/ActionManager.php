<?php
/**
 * PHP Extendtion Library (https://github.com/PsyduckMans/PHPX-Ext)
 *
 * @link      https://github.com/PsyduckMans/PHPX-Ext for the canonical source repository
 * @copyright Copyright (c) 2014 PsyduckMans (https://ninth.not-bad.org)
 * @license   https://github.com/PsyduckMans/PHPX-Ext/blob/master/LICENSE MIT
 * @author    Psyduck.Mans
 */

namespace PHPX\Ext\Direct;

use PHPX\Ext\Direct\Protocal\Router\UnitRouter;

/**
 * Class ActionManager
 * @package PHPX\Ext\Direct
 */
class ActionManager {
    /**
     * @var array
     */
    private $actions;

    /**
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config) {
        if(!isset($config['actions'])) {
            throw new \Exception('config["actions"] not found');
        }
        $this->actions = $config['actions'];
    }

    /**
     * @param UnitRouter $router
     * @return Action
     */
    public function loadAction(UnitRouter $router) {
        $target = $this->loadTargetBy($router);
        return new Action($target);
    }

    /**
     * @param UnitRouter $router
     * @return mixed
     * @throws \Exception
     */
    private function loadTargetBy(UnitRouter $router) {
        if(!$this->checkActionEnv($router)) {
            throw new \Exception('Remote router action:'.$router->getAction().' is unregistered');
        }

        $target = $this->actions[$router->getAction()];
        if(is_callable($target)) { /* Lazy load target */
            $target = call_user_func($this->actions[$router->getAction()]);
        }
        return $target;
    }
    /**
     * @param UnitRouter $router
     * @return bool
     */
    private function checkActionEnv(UnitRouter $router) {
        return isset($this->actions[$router->getAction()])
            && is_object($this->actions[$router->getAction()]);
    }
} 
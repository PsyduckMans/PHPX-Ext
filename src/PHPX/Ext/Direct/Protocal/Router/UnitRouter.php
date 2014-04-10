<?php
/**
 * PHP Extendtion Library (https://github.com/PsyduckMans/PHPX-Ext)
 *
 * @link      https://github.com/PsyduckMans/PHPX-Ext for the canonical source repository
 * @copyright Copyright (c) 2014 PsyduckMans (https://ninth.not-bad.org)
 * @license   https://github.com/PsyduckMans/PHPX-Ext/blob/master/LICENSE MIT
 * @author    Psyduck.Mans
 */

namespace PHPX\Ext\Direct\Protocal\Router;

/**
 * Class UnitRouter
 * @package PHPX\Ext\Direct\Protocal\Router
 */
class UnitRouter {
    /**
     * @var string
     */
    private $action;
    /**
     * @var string
     */
    private $method;

    /**
     * __construct
     *
     * @param $action
     * @param $method
     */
    public function __construct($action, $method) {
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
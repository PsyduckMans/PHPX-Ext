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

use PHPX\Proxy\DynamicProxy;

/**
 * Class Action
 * @package PHPX\Ext\Direct
 */
class Action extends DynamicProxy {
    /**
     * __construct
     *
     * @param $target
     */
    public function __construct($target) {
        $this->target = $target;
    }

    /**
     * @override
     * @param $name
     * @param $arguments
     * @throws \Exception
     */
    protected function __postCall($name, $arguments)
    {
        if(!$this->getResult() instanceof Result) {
            throw new \Exception(get_class($this->target).'->'.$name.' return is not instance of \PHPX\Ext\Direct\Result');
        }
    }
}
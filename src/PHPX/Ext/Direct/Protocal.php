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

/**
 * Class Protocal
 * @package PHPX\Ext\Direct
 */
abstract class Protocal implements ProtocalInterface {
    /**
     * @return string
     */
    public function toJson() {
        return json_encode($this->toArray());
    }
}
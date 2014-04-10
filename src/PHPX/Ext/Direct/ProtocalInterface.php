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
 * Interface ProtocalInterface
 * @package PHPX\Ext\Direct
 */
interface ProtocalInterface {
    /**
     * @param array $protocal
     * @return bool
     */
    public static function check(array $protocal);

    /**
     * @param array $protocal
     * @return BasiceProtocal
     */
    public static function create(array $protocal);

    /**
     * @return array
     */
    public function toArray();
} 
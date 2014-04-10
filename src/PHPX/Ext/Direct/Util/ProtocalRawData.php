<?php
/**
 * PHP Extendtion Library (https://github.com/PsyduckMans/PHPX-Ext)
 *
 * @link      https://github.com/PsyduckMans/PHPX-Ext for the canonical source repository
 * @copyright Copyright (c) 2014 PsyduckMans (https://ninth.not-bad.org)
 * @license   https://github.com/PsyduckMans/PHPX-Ext/blob/master/LICENSE MIT
 * @author    Psyduck.Mans
 */

namespace PHPX\Ext\Direct\Util;

/**
 * Class ProtocalRawData
 * @package PHPX\Ext\Direct\Util
 */
class ProtocalRawData {
    /**
     * @return array
     */
    public static function read() {
        $protocalData = json_decode(file_get_contents('php://input'), true);
        if(empty($protocalData)) {
            $protocalData = $_POST;
        }
        return $protocalData;
    }
} 
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

use PHPX\Ext\Direct\Protocal\BasicProtocal,
    PHPX\Ext\Direct\Protocal\BatchProtocal,
    PHPX\Ext\Direct\Protocal\NormalProtocal,
    PHPX\Ext\Direct\Protocal\FormHandlerProtocal;

/**
 * Class ProtocalFactory
 * @package PHPX\Ext\Direct
 */
class ProtocalFactory {
    /**
     * @param array $protocal
     * @return Protocal
     * @throws \Exception
     */
    public static function create(array $protocal) {
        $inst = null;
        switch(true) {
            case BatchProtocal::check($protocal):
                $inst = self::createBatchProtocal($protocal);
                break;
            case BasicProtocal::check($protocal):
                $inst = self::createBasicProtocal($protocal);
                break;
            default:
                throw new \Exception('Unknown protocal data:'.json_encode($protocal));
        }
        return $inst;
    }

    /**
     * @param array $protocal
     * @return Protocal
     * @throws \Exception
     */
    private static function createBasicProtocal(array $protocal) {
        $inst = null;
        switch(true) {
            case NormalProtocal::check($protocal):
                $inst = NormalProtocal::create($protocal);
                break;
            case FormHandlerProtocal::check($protocal):
                $inst = FormHandlerProtocal::create($protocal);
                break;
            default:
                throw new \Exception('Unknown basic protocal data:'.json_encode($protocal));
        }
        return $inst;
    }
    /**
     * @param array $protocal
     * @return BatchProtocal
     */
    private static function createBatchProtocal(array $protocal) {
        $batchProtocal = new BatchProtocal();
        foreach($protocal as $childProtocal) {
            $batchProtocal->add(self::create($childProtocal));
        }
        return $batchProtocal;
    }
}
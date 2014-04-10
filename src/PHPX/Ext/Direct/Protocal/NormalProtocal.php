<?php
/**
 * PHP Extendtion Library (https://github.com/PsyduckMans/PHPX-Ext)
 *
 * @link      https://github.com/PsyduckMans/PHPX-Ext for the canonical source repository
 * @copyright Copyright (c) 2014 PsyduckMans (https://ninth.not-bad.org)
 * @license   https://github.com/PsyduckMans/PHPX-Ext/blob/master/LICENSE MIT
 * @author    Psyduck.Mans
 */

namespace PHPX\Ext\Direct\Protocal;
use PHPX\Ext\Direct\Protocal\Router\UnitRouter;

/**
 * Class NormalProtocal
 * @package PHPX\Ext\Direct\Protocal
 */
class NormalProtocal extends BasicProtocal {
    /**
     * const form EXT field
     */
    const EXT_KEY_ACTION    = 'action';
    const EXT_KEY_METHOD    = 'method';
    const EXT_KEY_TID       = 'tid';
    const EXT_KEY_TYPE      = 'type';
    const EXT_KEY_DATA      = 'data';

    /**
     * @var array<FormField>
     */
    private static $baseMemberMapping = array(
        self::EXT_KEY_ACTION    => 'action',
        self::EXT_KEY_METHOD    => 'method',
        self::EXT_KEY_TID       => 'tid',
        self::EXT_KEY_TYPE      => 'type',
        self::EXT_KEY_DATA      => 'data'
    );

    /**
     * @overide
     * @param array $protocal
     * @return bool
     */
    public static function check(array $protocal)
    {
        foreach(array_keys(self::$baseMemberMapping) as $baseField) {
            if(!isset($protocal[$baseField])) {
                return false;
            }
        }
        return parent::check($protocal);
    }

    /**
     * @param array $protocal
     * @return BasicProtocal
     */
    public static function create(array $protocal)
    {
        $data = $protocal;
        $config = array();
        foreach(self::$baseMemberMapping as $baseField=>$mapMember) {
            $config[$mapMember] = $data[$baseField];
            unset($data[$baseField]);
        }
        return new self(
            $config[self::$baseMemberMapping[self::EXT_KEY_TID]],
            new UnitRouter(
                $config[self::$baseMemberMapping[self::EXT_KEY_ACTION]],
                $config[self::$baseMemberMapping[self::EXT_KEY_METHOD]]
            ),
            $config[self::$baseMemberMapping[self::EXT_KEY_TYPE]],
            $config[self::$baseMemberMapping[self::EXT_KEY_DATA]]
        );
    }
}
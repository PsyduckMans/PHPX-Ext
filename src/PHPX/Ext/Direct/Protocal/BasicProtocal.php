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

use PHPX\Ext\Direct\Protocal;
use PHPX\Ext\Direct\Result;

/**
 * Class BasicProtocal
 * @package PHPX\Ext\Direct\Protocal
 */
abstract class BasicProtocal extends Protocal {
    /**
     * const TYPE
     */
    const TYPE_RPC = 'rpc';

    /**
     * @var Router\UnitRouter
     */
    private $router;
    /**
     * @var string
     */
    private $tid;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $upload;
    /**
     * @var array
     */
    private $data;

    /**
     * __construct
     *
     * @param $tid
     * @param Router\UnitRouter $router
     * @param array $data
     * @param string $type
     * @param $upload
     */
    public function __construct($tid, Router\UnitRouter $router, $type=self::TYPE_RPC, array $data=array(), $upload=false) {
        $this->tid = $tid;
        $this->router = $router;
        $this->data = $data;
        $this->type = $type;
        $this->upload = $upload;
    }

    /**
     * @return Router\UnitRouter
     */
    public function getRouter() {
        return $this->router;
    }
    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @var Result
     */
    private $result;
    /**
     * @param Result $result
     */
    public function setResult(Result $result)
    {
        $this->result = $result;
    }

    /**
     * @param array $protocal
     * @return bool
     */
    public static function check(array $protocal)
    {
        foreach(array_keys($protocal) as $key) {
            if(is_string($key)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'tid' => $this->tid,
            'action' => $this->router->getAction(),
            'method' => $this->router->getMethod(),
            'type' => $this->type,
            'result' => $this->result->toArray()
        );
    }
}
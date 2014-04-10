<?php
/**
 * PHP Extendtion Library (https://github.com/PsyduckMans/PHPX-Ext)
 *
 * @link      https://github.com/PsyduckMans/PHPX-Ext for the canonical source repository
 * @copyright Copyright (c) 2014 PsyduckMans (https://ninth.not-bad.org)
 * @license   https://github.com/PsyduckMans/PHPX-Ext/blob/master/LICENSE MIT
 * @author    Psyduck.Mans
 */

namespace PHPX\Ext\Direct\Result;

use PHPX\Ext\Direct\Result;

/**
 * Class Failure
 * @package PHPX\Ext\Direct\Result
 */
class Failure extends Result {
    /**
     * @var string
     */
    private $message;
    /**
     * @var array
     */
    private $data;

    /**
     * @param string $message
     * @param array $data
     */
    public function __construct($message, array $data=array()) {
        $this->message = $message;
        $this->data = $data;
    }
    /**
     * @return array
     */
    public function data()
    {
        return $this->data;
    }
    /**
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * @return bool
     */
    public function status()
    {
        return false;
    }

    /**
     * @overide
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->data, parent::toArray());
    }
}
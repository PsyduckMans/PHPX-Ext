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
 * Class Success
 * @package PHPX\Ext\Direct\Result
 */
class Success extends Result {
    /**
     * @var array
     */
    private $data;
    /**
     * @var string
     */
    private $message;

    /**
     * __construct
     *
     * @param array $data
     * @param string $message
     */
    public function __construct(array $data, $message=null) {
        $this->data = $data;
        $this->message = $message;
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
        return true;
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
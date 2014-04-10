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

use PHPX\Ext\Direct\BasiceProtocal;
use PHPX\Ext\Direct\Protocal;

/**
 * Class BatchProtocal
 * @package PHPX\Ext\Direct\Protocal
 */
class BatchProtocal extends Protocal implements \Iterator {
    /**
     * @var array<\PHPX\Ext\Direct\Protocal>
     */
    private $protocals = array();

    /**
     * __construct
     */
    public function __construct(array $protocals=array()) {
        $this->position = 0;
        $this->protocals = $protocals;
    }

    /**
     * @param array<Protocal> $protocals
     * @return BasiceProtocal
     */
    public static function create(array $protocals)
    {
        return new self($protocals);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $protocalArray = array();
        foreach($this->protocals as $protocal) {
            array_push($protocalArray, $protocal->toArray());
        }
        return $protocalArray;
    }

    /**
     * @param Protocal $protocal
     * @return int the new number of elements in the $protocals.
     */
    public function add(Protocal $protocal) {
        return array_push($this->protocals, $protocal);
    }

    /**
     * @param array $protocal
     * @return bool
     */
    public static function check(array $protocal)
    {
        foreach(array_keys($protocal) as $key) {
            if(is_string($key)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @var int
     */
    private $position;
    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->protocals[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->protocals[$this->position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
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
 * Class Result
 * @package PHPX\Ext\Direct
 */
abstract class Result {
    /**
     * @return array
     */
    public abstract function data();

    /**
     * @return string
     */
    public abstract function message();

    /**
     * @return bool
     */
    public abstract function status();

    /**
     * @return array
     */
    public function toArray() {
        $result = array('success' => $this->status());
        if($this->message())
            $result = array_merge($result, array('msg'=>$this->message()));
        return $result;
    }
} 
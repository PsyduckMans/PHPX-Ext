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

use PHPX\Ext\Direct\Protocal\BasicProtocal;
use PHPX\Ext\Direct\Protocal\BatchProtocal;
use PHPX\Ext\Direct\Result\Failure;

/**
 * Class ProcesseHandler
 * @package PHPX\Ext\Direct
 */
class ProcesseHandler {
    const ACTION_METHOD_SUFFIX = 'Method';

    /**
     * @param Protocal $protocal
     * @return Protocal
     * @throws \Exception
     */
    public function execute(Protocal $protocal) {
        if($protocal instanceof BasicProtocal) {
            $this->executeWithBasic($protocal);
        } else if($protocal instanceof BatchProtocal) {
            $this->executeWithBatch($protocal);
        } else {
            throw new \Exception('Unsupport protocal class:'.get_class($protocal));
        }
        return $protocal;
    }

    /**
     * @param BasicProtocal $basicProtocal
     * @throws \Exception
     */
    private function executeWithBasic(BasicProtocal $basicProtocal) {
        // init
        $result = null;

        // handle
        try {
            $action = $this->actionManager->loadAction($basicProtocal->getRouter());
            $method = $basicProtocal->getRouter()->getMethod().self::ACTION_METHOD_SUFFIX;
            $data   = $basicProtocal->getData();
            $result = $action->{$method}($data);
        } catch(\PHPX\Ext\Direct\RuntimeException $e) {
            $result = new Failure($e->getMessage());
        } catch(\Exception $e) {
            // TODO server error handler & log->($e)
            $result = new Failure('服务器异常');
        }

        $basicProtocal->setResult($result);
    }
    /**
     * @param BatchProtocal $batchProtocal
     */
    private function executeWithBatch(BatchProtocal $batchProtocal) {
        foreach($batchProtocal as $childProtocal) {
            $this->execute($childProtocal);
        }
    }

    /**
     * @var self
     */
    private static $instance;
    /**
     * @return ProcesseHandler
     */
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @var ActionManager
     */
    private $actionManager;
    /**
     * @param $actionManager
     * @return $this
     */
    public function setActionManager($actionManager)
    {
        $this->actionManager = $actionManager;
        return $this;
    }
}
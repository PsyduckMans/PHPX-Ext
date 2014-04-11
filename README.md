PHPX-Ext
========

PHPX/Ext library for ExtJS

## usage
### api.js
    Ext.app.REMOTING_API = {
        type: 'remoting',
        url: 'api/router.php',
        actions: {
            "Ext.app.Login": [
                {name: 'check', formHandler:true, len:1},
                {name: 'quit', len:1}
            ],
            "Ext.app.Customer": [
                {name: 'treeList', len:1}
            ],
            "Ext.app.Product": [
                {name: 'list', len:1},
                {name: 'add', formHandler:true, len:1},
                {name: 'edit', formHandler:true, len:1},
                {name: 'delete', len:1}
            ]
        }
    };

### api/router.php
    require 'vendor/autoload.php';
    try {
        $protocal = \PHPX\Ext\Direct\ProtocalFactory::create(
            \PHPX\Ext\Direct\Util\ProtocalRawData::read()
        );

        $processHandler = \PHPX\Ext\Direct\ProcesseHandler::getInstance()
            ->setActionManager(new \PHPX\Ext\Direct\ActionManager(array(
                'actions' => array(
                    'Ext.app.Login' => new \AppDemo\Ext\Action\LoginAction(),
                    'Ext.app.Customer' => new \AppDemo\Ext\Action\CustomerAction(),
                    'Ext.app.Product' => new \AppDemo\Ext\Action\ProductAction()
                )
            )));
        $processHandler->execute($protocal);

        echo $protocal->toJson();
    } catch(\Exception $e) {
        // log & exception handler
    }

### \AppDemo\Ext\Action\LoginAction.php
    namespace AppDemo\Ext\Action;

    use PHPX\Ext\Direct\Action;
    use PHPX\Ext\Direct\Result\Success;

    /**
     * Class LoginAction
     * @package AppDemo\Ext\Action
     */
    class LoginAction {
        public function checkMethod(array $data) {
            $vcode = $data['vcode'];
            $seccode = $_SESSION["seccode"];
            if($vcode !== $seccode) {
                // log vcode & seccode
                throw new \Exception('验证码错误');
            }

            // authentication login handler ...
            
            return new Success(
                array('userInfo' => array(
                    'role' => 'administrator'
                )),
                '登陆成功'
            );
        }

        public function quitMethod(array $data) {
            // authentication logout handler ...
            return new Success(array(), '退出成功');
        }
    }
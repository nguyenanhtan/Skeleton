<?php
namespace Backen;
use Zend\Db\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
       return [
            'factories' => [
                Model\IrregularTable::class => function($container) {
                    $tableGateway = $container->get(Model\IrregularTableGateway::class);
                    return new Model\IrregularTable($tableGateway);
                },
                Model\IrregularTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Irregular());
                    return new TableGateway('IRREGULAR', $dbAdapter, null, $resultSetPrototype);
                },
                Model\PhrasalTable::class => function($container) {
                    $tableGateway = $container->get(Model\PhrasalTableGateway::class);
                    return new Model\PhrasalTable($tableGateway);
                },
                Model\PhrasalTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Phrasal());
                    return new TableGateway('PHRASALS', $dbAdapter, null, $resultSetPrototype);
                },
                Model\Categories::class => function($container) {
                    $tableGateway = $container->get(Model\CategoryTableGateway::class);
                    return new Model\Categories($tableGateway);
                },
                Model\CategoryTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Category());
                    return new TableGateway('CATEGORIES', $dbAdapter, null, $resultSetPrototype);
                },                
                Model\Test::class => function($container){
                    $dbAdapter = $container->get(AdapterInterface::class);
                    return new Model\Test($dbAdapter);
                }
                
            ],
        ];
         /*return [
            Adaper\Adapter::class => function($container) {
                $config = $container->get('config');
                return new Adapter\Adapter($config['db']);
            }
        ];*/
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\BackenController::class => function($container) {
                    return new Controller\BackenController(
                        $container->get(Model\IrregularTable::class),
                        $container->get(Model\PhrasalTable::class),
                        $container->get(Model\Article::class),
                        $container->get(Model\Category::class)                        
                    );
                },
                Controller\AjaxController::class => function($container){
                    return new Controller\AjaxController(
                        $container->get(Model\IrregularTable::class),
                        $container->get(Model\Category::class)
                    );
                },
                Controller\BlogController::class => function($container){
                    return new Controller\BlogController(                        
                        $container->get(Model\Categories::class)
                    );
                },
            ],
        ];
    }
}
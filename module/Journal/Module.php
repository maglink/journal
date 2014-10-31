<?php
namespace Journal;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
 
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    public function getServiceConfig()
    {
        $models = array();
        $models[] = 'Grade';
        $models[] = 'Unit';
        $models[] = 'Subject';
        $models[] = 'Lesson';
        $models[] = 'Mark';
        
        $favorites = array();
        foreach($models as $model):
            $favorites['Journal\Model\\'.$model.'Table'] = function($sm) use($model){
                $tableGateway = $sm->get($model.'TableGateway');
                $class = 'Journal\Model\\'.$model.'Table';
                $table = new $class($tableGateway);
                return $table;
            };
            $favorites[$model.'TableGateway'] = function ($sm) use($model) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $class = 'Journal\Model\\'.$model;
                $resultSetPrototype->setArrayObjectPrototype(new $class());
                return new TableGateway(strtolower($model), $dbAdapter, null, $resultSetPrototype);
            };
        endforeach;

        return array(
            'factories' => $favorites
        );
    }
}
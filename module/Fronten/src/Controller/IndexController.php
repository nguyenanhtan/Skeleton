<?php
namespace Fronten\Controller;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e){
        $response = parent::onDispatch($e);
        $this->layout()->setTemplate('layout/layoutfronten');
        return $response;
    }
    public function indexAction()
    {
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
    public function grammarAction(){
        
    }
}
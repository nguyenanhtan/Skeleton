<?php
namespace Backen\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backen\Model\IrregularTable;
use Backen\Model\Irregular;
use Backen\Model\PhrasalTable;
use Backen\Model\Test;
use Backen\Model\Category;

use Backen\Form\AddIrregularForm;
use Backen\Form\CategoryForm;
class AjaxController extends AbstractActionController
{
	private $table;
    private $category;
    public function __construct(IrregularTable $table, Category $category)
    {
        $this->table = $table;
        $this->category = $category;
    }
	public function indexAction()
    {

    }
    public function editirregularAction(){        
        
    }
    public function deleteirregularAction(){
        $id = $this->params()->fromRoute('id',-1);        
        $this->table->deleteIrregular($id);
        echo "Deleted";        
        exit;
    }
    
    public function addirregularAction()
    {
    	$sig = "NONE";
        $form = new AddIrregularForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
        //if (! $request->isXmlHttpRequest()) {
            $sig = "Request is not Post";
            echo $sig;
            //return ['form' => $form,'sig' => $sig];
        }

        $irregular = new Irregular();
        $form->setInputFilter($irregular->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            $sig = "Form is invalid";
            //return $this->redirect()->toRoute('backen',['action'=>'add','id'=>'0']);
            echo $sig;
            exit;
            //return ['form' => $form,'sig' => $sig];
        }

        $irregular->exchangeArray($form->getData());
        $this->table->saveIrregular($irregular);
        
        echo json_encode($irregular);
        //return \Zend\Json\Json::encode(["as"=>"dsaf",'dasd'=>'sfdgshf']);
        exit;

    }
    public function addCategoryAction(){
        //$form = new CategoryForm();
        //$form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
        //if (! $request->isXmlHttpRequest()) {
            $sig = "Request is not Post";
            echo $sig;
            //return ['form' => $form,'sig' => $sig];
        }

        //$category = new Category();        

        $this->category->exchangeArray($request->getPost()->toArray());
        $this->category->insert();
        echo json_encode($request->getPost()->toArray());
        //echo json_encode($pop);
        //return \Zend\Json\Json::encode(["as"=>"dsaf",'dasd'=>'sfdgshf']);
        //$this->url()->fromRoute("backen",["action"=>"blogCategory"]);
        exit;
    }
    public function editCategoryAction(){
        
    }
    public function deleteCategoryAction(){
        $request = $this->getRequest();

        if (! $request->isPost()) {
        //if (! $request->isXmlHttpRequest()) {
            $sig = "Request is not Post";
            echo $sig;
            //return ['form' => $form,'sig' => $sig];
        }

        //$category = new Category();        
        $id = $this->params()->fromRoute('id',-1);  
        
        $this->category->update(["parent"=>0],["parent"=>$id]);
        $this->category->delete(["id"=>$id]);        
        echo json_encode("Deleted ".$id);    
        exit;
    }
}
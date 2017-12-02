<?php
namespace Backen\Controller;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backen\Model\IrregularTable;
use Backen\Model\Irregular;
use Backen\Model\PhrasalTable;
use Backen\Model\Article;
use Backen\Model\Category;
use Backen\Form\AddIrregularForm;
class BackenController extends AbstractActionController
{
    private $table;
    private $phrasal;
    private $article;
    private $category;
    
    public function __construct(IrregularTable $table, PhrasalTable $phrasal, Article $article, Category $category)
    {
        $this->table = $table;
        $this->phrasal = $phrasal;
        $this->article = $article;
        $this->category = $category;
        
    }
    public function onDispatch(MvcEvent $e){
        $response = parent::onDispatch($e);
        $this->layout()->setTemplate('layout/layoutbacken');
        return $response;
    }
    public function indexAction()
    {       
        $form = new AddIrregularForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        return new ViewModel([
            'irregulars' => $this->table->fetchAll(),
            'info' => $this->article->getTable(),
            'form' => $form,]);
    }

    public function addAction()
    {
        $sig = "NONE";
        $form = new AddIrregularForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
        //if (! $request->isXmlHttpRequest()) {
            $sig = "Request is not Post";
            echo $sig;
            return ['form' => $form,'sig' => $sig];
        }        
        
    }
    public function editAction()
    {

    }

    public function deleteAction()
    {
        return new ViewModel([
            'phrasal' => $this->phrasal->fetchAll(),
        ]);
    }
    public function blogCategoryAction(){
        return new ViewModel([
            "categories"=>$this->category->select(),
            ]);
    }

    public function blogTopicAction(){

    }
    public function blogArticleAction(){

    }
    
}
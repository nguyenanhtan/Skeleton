<?php
namespace Backen\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backen\Model\Categories;
use Backen\Model\Category;
class BlogController extends AbstractActionController
{
	public $categories;
	public function __construct(Categories $categories)
    {     
        $this->categories = $categories;
    }
    public function onDispatch(MvcEvent $e){
        $response = parent::onDispatch($e);
        $this->layout()->setTemplate('layout/layoutbacken');
        return $response;
    }
    public function addCategoryAction(){
        //$form = new CategoryForm();
        //$form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            $sig = "Request is not Post";
            echo $sig;
        }   
        $cat = new Category();
        //echo "1";
        $cat->set($request->getPost()->toArray());         
        //echo "1";
        $this->categories->save($cat);
        //echo "1";
        echo json_encode($request->getPost()->toArray());
        //echo json_encode($pop);
        //return \Zend\Json\Json::encode(["as"=>"dsaf",'dasd'=>'sfdgshf']);
        //$this->url()->fromRoute("backen",["action"=>"blogCategory"]);
        exit;
    }
    public function deleteCategoryAction(){
        $id = $this->params()->fromRoute('id',-1); 
        echo "id= ".$id;
        $this->categories->delete($id);

        echo "deleted";  
        exit;
    }
    public function getCategoriesAction(){
        $cats = $this->categories->fetchAll();
        $tree = array();
        foreach ($cats as $row) {
            # code...
            if($row->parent == $row->id){
                continue;
            }
            elseif(!array_key_exists($row->parent,$tree)){
                $tree[$row->parent] = array();
                array_push($tree[$row->parent],$row->id);
            }else{
                array_push($tree[$row->parent], $row->id);
            }
        }
        $arr = array();
        foreach ($this->categories->fetchAll() as $row) {
            # code...
            $arr[$row->id]=$row;
            //$arr[$row->id]["passed"] = false;
        }
        echo json_encode(["tree"=>$tree,"arr"=>$arr]);
        // echo json_encode($tree);
        // echo json_encode($arr);
        exit;
    }
    public function categoriesAction(){
    	
        //echo json_encode($tree);
        //echo json_encode($arr);
        return new ViewModel([
            "categories"=>$this->categories->fetchAll(),            
            ]);
    }
    public function articleAction(){
        return new ViewModel([
            "categories"=>$this->categories->fetchAll(),
            ]);
    }
    public function saveArticleAction(){
        $request = $this->getRequest();
        echo json_encode($request->getPost()->toArray());
        exit;
    }
    private function treecat($id_nod,$tree, $arr){
        if($arr[$id_nod]["passed"] == true){
            return;
        }
        else{
            foreach ($tree[$id_nod] as $row) {
                # code...
                treecat($row->id,$tree,$arr);
            }
        }
    }
}
<?php
namespace Backen\Model;
use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Db\Sql\Sql;
class Category
{
    public $id;
    public $title;
    public $parent;
    protected $_dependentTables = array('CategoryTopic');
    protected $sql;
    protected $_name = "CATEGORIES";
    public function __construct(Sql $sql)
    {
        $this->sql = $sql;        
    }
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->title     = !empty($data['title']) ? $data['title'] : null;     
        $this->parent     = !empty($data['parent']) ? $data['parent'] : 0;     
              
    }  
    function select(array $where = null){
        $select = $this->sql->select();
        $select->from($this->_name);
        if($where != null){
            $select->where($where);
        }
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        return $results;
    }
    function insert(array $values = null){
        if($values == null){
            $values = ["title"=>$this->title,"parent"=>$this->parent];
        }
        $insert = $this->sql->insert();
        $insert->into($this->_name);
        $insert->values($values);

        $statement = $this->sql->prepareStatementForSqlObject($insert);
        $results = $statement->execute();
        //$results->buffer();
        //$results->next();
        return $results;
    }
    
    function update(array $new_value, $where){         
        $update = $this->sql->update();
        $update->table($this->_name);
        $update->set($new_value);
        $update->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($update);
        $results = $statement->execute();
        return $results;
    }
    function delete($where){ 
        if($where == null){
            $where = ["id"=>$this->id];
        }
        $delete = $this->sql->delete();
        $delete->from($this->_name);        
        $delete->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        $results = $statement->execute();
        return $results;
    }
    
    
}
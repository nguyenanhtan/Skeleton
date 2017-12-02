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
use Zend\Db\Adapter\AdapterInterface;
class Article
{
    public $id;
    public $title;
    public $content;
    public $author;
    public $date;
    private $topic;
    // protected $_db;
    protected $_name = 'ARTICLES';
    protected $_dependentTables = array("TopicArticle");
    protected $sql;
    public function __construct(Sql $sql)
    {
        $this->sql = $sql;        
    }
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->title     = !empty($data['title']) ? $data['title'] : null;
        $this->content     = !empty($data['content']) ? $data['content'] : null;
        $this->author     = !empty($data['author']) ? $data['author'] : null;
        $this->date     = !empty($data['date']) ? $data['date'] : null;
        $this->topic     = !empty($data['topic']) ? $data['topic'] : null;
        
    }
    function getTable(){
        $select = $this->sql->select();
        $select->from($this->_name);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        return $results;
    }
}
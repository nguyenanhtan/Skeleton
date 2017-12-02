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
class Topic  extends Zend_Db_Table_Abstract
{
    public $id;
    public $title;
    public $category;
    protected $_name = 'TOPICS';
    protected $_dependentTables = array("TopicArticle","CategoryTopic");
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->title     = !empty($data['title']) ? $data['title'] : null;
        $this->category     = !empty($data['category']) ? $data['category'] : null;        
        
    }
}
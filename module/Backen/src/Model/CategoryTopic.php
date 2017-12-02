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
class CategoryTopic extends Zend_Db_Table_Abstract
{
    private $category;
    private $topic;
    protected $_name = 'CATEGORY_TOPIC';
    // protected $_referenceMap    = array(
    //     'Category' => array(
    //         'columns'           => 'category',
    //         'refTableClass'     => 'Category',
    //         'refColumns'        => 'id'
    //     ),  
    //     'Topic' => array(
    //         'columns'           => 'topic',
    //         'refTableClass'     => 'Topic',
    //         'refColumns'        => 'id'
    //     ),     
    // );
    public function exchangeArray(array $data)
    {
        $this->category     = !empty($data['category']) ? $data['category'] : null;
       
        $this->topic     = !empty($data['topic']) ? $data['topic'] : null;
       
        
     }
}
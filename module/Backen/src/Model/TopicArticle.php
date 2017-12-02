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
class TopicArticle extends Zend_Db_Table_Abstract
{
    private $article;
    private $topic;
    protected $_name = 'TOPIC_ARTICLE';
    // protected $_referenceMap    = array(
    //     'Article' => array(
    //         'columns'           => 'article',
    //         'refTableClass'     => 'Article',
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
        $this->article     = !empty($data['article']) ? $data['article'] : null;
       
        $this->topic     = !empty($data['topic']) ? $data['topic'] : null;
       
        
     }
}
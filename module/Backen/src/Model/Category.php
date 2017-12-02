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
class Category
{
    public $id;
    public $title;
    public $parent;
    public function set(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
        $this->parent  = !empty($data['parent']) ? $data['parent'] : null;
        
    }
    public function exchangeArray(array $data){
        $this->set($data);
    }

}
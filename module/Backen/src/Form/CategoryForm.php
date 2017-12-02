<?php
namespace Backen\Form;

use Zend\Form\Form;

class CategoryForm extends Form{
	public function __construct($name = null){
		parent::__construct("add-irregular");
		$this->add([
            'name' => 'id',
            'type' => 'hidden',
            // 'id' => 'irregular-form',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',           
            'options' => [
                'label' => 'Title',
            ],
        ]);
        
}
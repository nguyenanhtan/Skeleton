<?php
namespace Backen\Form;

use Zend\Form\Form;

class AddIrregularForm extends Form{
	public function __construct($name = null){
		parent::__construct("add-irregular");
		$this->add([
            'name' => 'id',
            'type' => 'hidden',
            // 'id' => 'irregular-form',
        ]);
        $this->add([
            'name' => 'simple',
            'type' => 'text',
            'attributes' => [
                'value' => 'Go',               
            ],
            'options' => [
                'label' => 'Simple',
            ],
        ]);
        $this->add([
            'name' => 'simple_past',
            'type' => 'text',
            'attributes' => [
                'value' => 'Go',               
            ],
            'options' => [
                'label' => 'Simple Past',
            ],
        ]);
        $this->add([
            'name' => 'past_participle',
            'type' => 'text',
            'attributes' => [
                'value' => 'Go',               
            ],
            'options' => [
                'label' => 'Past participle',
            ],
        ]);
        $this->add([
            'name' => 'meaning',
            'type' => 'text',
            'attributes' => [
                'value' => 'Go',               
            ],
            'options' => [
                'label' => 'Meaning',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
        // $this->setAttribute('method', 'GET');
	}
}
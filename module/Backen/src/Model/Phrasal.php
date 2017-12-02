<?php
namespace Backen\Model;

class Phrasal
{
    public $id;
    public $phrasal_verb;
    public $example;
    public $meaning;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->phrasal_verb = !empty($data['phrasal_verb']) ? $data['phrasal_verb'] : null;
        $this->example  = !empty($data['example']) ? $data['example'] : null;
        
        $this->meaning  = !empty($data['meaning']) ? $data['meaning'] : null;
        
    }
}
<?php
namespace Backen\Model;
use Zend\Db\Adapter\AdapterInterface;
 class Test{
 	private $adapter;
 	public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    public function info(){
    	echo $this->adapter->getPlatform()->getName();
    }
 }
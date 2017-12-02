<?php
namespace Backen\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class Categories
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getCategory($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }
    public function getParent(Category $category){
        return getCategory($category->parent);
    }
    public function save(Category $category)
    {
        $data = [            
            'title' => $category->title,
            'parent' => $category->parent,                                  
        ];

        $id = (int) $category->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getCategory($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
        $this->tableGateway->update(["parent"=>1],["parent"=>$id]);
    }
}

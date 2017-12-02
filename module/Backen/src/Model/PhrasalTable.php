<?php
namespace Backen\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class PhrasalTable
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

    public function getPhrasal($id)
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

    public function savePhrasal(Phrasal $phrasal)
    {
        $data = [
            'phrasal_verb' => $phrasal->phrasal_verb,
            'example'  => $phrasal->example,           
            'meaning'  => $phrasal->meaning,
            
        ];

        $id = (int) $phrasal->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getIrregular($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deletePhrasal($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}

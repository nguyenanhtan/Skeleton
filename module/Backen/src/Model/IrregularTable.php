<?php
namespace Backen\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class IrregularTable
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

    public function getIrregular($id)
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

    public function saveIrregular(Irregular $irregular)
    {
        $data = [
            'simple' => $irregular->simple,
            'simple_past'  => $irregular->simple_past,
            'past_participle'  => $irregular->past_participle,
            'meaning'  => $irregular->meaning,
            
        ];

        $id = (int) $irregular->id;

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

    public function deleteIrregular($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}

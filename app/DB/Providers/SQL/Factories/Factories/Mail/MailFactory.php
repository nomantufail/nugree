<?php

namespace App\DB\Providers\SQL\Factories\Factories\Mail;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */


use App\DB\Providers\SQL\Factories\Factories\Mail\Gateways\MailQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Mail;

class MailFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Mail();
        $this->tableGateway = new MailQueryBuilder();
    }
    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    function storeContactUsMail($record)
    {
        return $this->tableGateway->insert($this->mapOnTable($record));
    }
    function mapOnTable($record)
    {
        return[
            'type'=>$record['type'],
            'json'=>json_encode($record)
        ];
    }
    function map($result)
    {
        $mail = clone($this->model);
        $mail->id=$result->id;
        $mail->type =$result->type;
        $mail->json = json_decode($result->json);
        $mail->createdAt = $result->created_at;
        $mail->updatedAt = $result->updated_at;
        return $mail;
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}
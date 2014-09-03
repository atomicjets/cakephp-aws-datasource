<?php
App::uses('AwsModel', 'AwsDatasource.Model');

class AwsDynamoDbModel extends AwsModel {
  public $useDbConfig = 'aws_dynamodb';
  public $returnConsumedCapacity = 'NONE';

  public function __call($method, $args) {
    switch (strtolower($method)) {
      case 'putitem':
      case 'createtable':
      case 'waituntil':
      case 'deleteitem':
      case 'deletetable':
      case 'describetable';
      case 'getitem';
      case 'query';
      case 'scan';
      case 'updateitem';
      case 'updatetable';
      case 'waituntiltableexists':
      case 'waituntiltablenotexists';
        $args[0] += array(
          'TableName' => $this->getDataSource()->getTable(),
        );
      break;
    }
    $args[0] += array(
      'ReturnConsumedCapacity' => $this->returnConsumedCapacity,
    );
    return call_user_func_array(array($this->getClient(), $method), $args);
  }

  public function query($sql) {
    return $this->__call('query', func_get_args());
  }

  public function getClient() {
    return $this->getDataSource()->getClient();
  }

  public function getTable() {
    return $this->getDataSource()->getTable();
  }
}


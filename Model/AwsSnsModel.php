<?php
App::uses('AwsModel', 'AwsDatasource.Model');

class AwsSnsModel extends AwsModel {
  public $useDbConfig = 'aws_sns';

  public function SnsClient() {
    return $this->getDataSource()->getSnsClient();
  }
}


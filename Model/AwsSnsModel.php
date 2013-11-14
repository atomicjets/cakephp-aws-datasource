<?php
App::uses('AwsModel', 'AwsDatasource.Model');

class AwsSnsModel extends AwsModel {
  public $useDbConfig = 'aws_sns';

  public function SnsClient() {
    return $this->getDataSource()->getSnsClient();
  }

  public function getRegion() {
    return $this->getDataSource()->getConfig('region');
  }

  public function getPlatformApplicationArn() {
    return $this->getDataSource()->getConfig('platform_application_arn');
  }
}


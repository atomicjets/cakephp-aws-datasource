<?php
App::uses('AwsSource', 'AwsDatasource.Model/Datasource');

use Aws\Common\Aws;

class AwsS3Source extends AwsSource {

  protected $_connection = null;

  public function listSources($data = null) {
  }

  public function getBucket() {
    return $this->config['bucket'];
  }

}


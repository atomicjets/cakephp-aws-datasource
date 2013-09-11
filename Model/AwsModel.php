<?php
use Guzzle\Service\Builder\ServiceBuilderInterface;

class AwsModel extends AppModel implements ServiceBuilderInterface {
  public $useDbConfig = 'aws';

  public function get($name, $throwAway = false) {
    return ConnectionManager::getDataSource($this->useDbConfig)->get($name, $throwAway);
  }

  public function set($key, $service) {
    return ConnectionManager::getDataSource($this->useDbConfig)->set($key, $service);
  }
}

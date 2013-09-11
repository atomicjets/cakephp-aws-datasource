<?php
App::uses('DataSource', 'Model/Datasource');

use Aws\Common\Aws;
use Guzzle\Service\Builder\ServiceBuilderInterface;

class AwsSource extends DataSource implements ServiceBuilderInterface {

  protected $_connection = null;

  public function __construct($config = null, $autoConnect = true) {
    parent::__construct($config);
    if (!$this->enabled()) {
      throw new MissingConnectionException(array(
        'class' => get_class($this),
        'message' => __d('cake_dev', 'Selected driver is not enabled'),
        'enabled' => false
      ));
    }
    if ($autoConnect) {
      return $this->connect();
    }
  }

  public function enabled() {
    return extension_loaded('redis');
  }

  public function connect() {
    $config = $this->config;
    $this->connected = false;

    try {
      $this->_connection = Aws::factory($config);
      $this->connected = true;
    } catch (Exception $e) {
      throw new MissingConnectionException(array(
        'class' => get_class($this),
        'message' => $e->getMessage(),
      ));
    }

    return $this->connected;
  }

  public function close() {
    if ($this->connected == true) {
      unset($this->_connection);
      $this->_connection = null;
      $this->connected = false;
    }
    return true;
  }

  public function query($method, $params, $model) {
    return call_user_func_array(array($this->_connection, $method), $params);
  }

  public function listSources($data = null) {
  }

  public function get($name, $throwAway = false) {
    return $this->connection->get($name, $throwAway);
  }
  public function set($key, $service) {
    return $this->connection->set($key, $service);
  }
}

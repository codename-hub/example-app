<?php
namespace examplevendor\example;

class app extends \codename\rest\app {


  /**
   * @inheritDoc
   */
  public function __CONSTRUCT()
  {
    static::$namespace = '\\examplevendor\\example';
    static::$homedir = 'examplevendor/example-app';

    // inject rest (lib)
    self::injectApp(array(
      'vendor' => 'codename',
      'app' => 'rest',
      'namespace' => '\\codename\\rest'
    ));

    parent::__CONSTRUCT();
  }

  /**
   * @inheritDoc
   */
  public function run()
  {
    $qualifier = self::getEndpointQualifier();
    $this->getRequest()->addData($qualifier);
    parent::run();
  }

  /**
   * @inheritDoc
   */
  protected static function shouldThrowException(): bool
  {
    return true;
  }
}

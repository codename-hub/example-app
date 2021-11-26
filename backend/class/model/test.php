<?php
namespace examplevendor\example\model;

class test extends \codename\core\model\schematic\sql
{
  /**
   * @inheritDoc
   */
  public function __CONSTRUCT(array $modeldata = array())
  {
    parent::__CONSTRUCT($modeldata);
    $this->setConfig(null, 'testschema', 'test');
  }
}

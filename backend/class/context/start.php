<?php
namespace examplevendor\example\context;

class start extends \codename\core\context
{
  /**
   * [view_default description]
   */
  public function view_default(): void {
    $this->getResponse()->setData('someKey', 'someValue');
  }

  /**
   * [view_create description]
   */
  public function view_create(): void {

    $model = $this->getModel('test');

    $model->save([
      'test_data' => $this->getRequest()->getData('test_data')
    ]);

    $id = $model->lastInsertId();

    $dataset = $model->load($id);

    $this->getResponse()->setData('dataset', $dataset);
  }
}

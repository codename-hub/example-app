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

  /**
   * [view_exampleform description]
   */
  public function view_exampleform(): void {
    $form = new \codename\core\ui\form([
      'form_id' => 'example',
      'form_method' => 'POST',
      'form_action' => '',
    ]);

    $form->addField(new \codename\core\ui\field([
      'field_type'  => 'input',
      'field_title' => 'Simple text input',
      'field_name'  => 'simple_text_input',
    ]));

    $form->addField(new \codename\core\ui\field([
      'field_type'      => 'input',
      'field_title'     => 'Simple number input',
      'field_datatype'  => 'number_natural',
      'field_name'      => 'simple_number_input',
    ]));

    $form->addField(new \codename\core\ui\field([
      'field_type'      => 'input',
      'field_required'  => true,
      'field_title'     => 'Simple required email input',
      'field_datatype'  => 'text_email',
      'field_name'      => 'simple_required_input',
    ]));

    $form->addField(new \codename\core\ui\field([
      'field_type'  => 'submit',
      'field_title' => 'Submit',
      'field_value' => 'Submit',
      'field_name'  => 'some_submit_field',
    ]));

    if($form->isSent()) {
      $this->getResponse()->setData('recent_formdata_valid', $form->isValid());

      // reset errorstack, as a call to ->isValid() will add messages to the errorstack
      $form->getErrorstack()->reset();

      if(!$form->isValid()) {
        $this->getResponse()->setData('recent_formdata_errors', $form->getErrorstack()->getErrors());
      }

      $this->getResponse()->setData('recent_formdata', $form->getData());
      $this->getResponse()->setData('recent_formdata_normalized', $form->normalizeData($form->getData()));
    }

    $this->getResponse()->setData('form', $form->output());
  }
}

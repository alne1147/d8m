<?php

namespace Drupal\webform\Tests;

use Drupal\webform\Entity\Webform;

/**
 * Tests for remote post webform handler functionality.
 *
 * @group Webform
 */
class WebformHandlerRemotePostTest extends WebformTestBase {

  /**
   * Test remote post handler.
   */
  public function testRemotePostHandler() {
    /** @var \Drupal\webform\WebformInterface $webform_handler_remote */
    $webform_handler_remote = Webform::load('test_handler_remote_post');

    $this->drupalLogin($this->adminFormUser);

    // Check remote post 'create' operation.
    $sid = $this->postSubmission($webform_handler_remote);
    $this->assertPattern('#<label>Remote operation</label>\s+insert#ms');

    // Check remote post 'update' operation.
    $this->drupalPostForm("admin/structure/webform/manage/test_handler_remote_post/submission/$sid/edit", [], t('Save'));
    $this->assertPattern('#<label>Remote operation</label>\s+update#ms');

    // Check remote post 'delete' operation.
    $this->drupalPostForm("admin/structure/webform/manage/test_handler_remote_post/submission/$sid/delete", [], t('Delete'));
    $this->assertPattern('#<label>Remote operation</label>\s+delete#ms');

    // @todo Figure out why the below test is failing on Drupal.org.
    // Check remote post 'create' 500 error handling.
    // $this->postSubmission($webform_handler_remote, ['first_name' => 'FAIL']);
    // $this->assertPattern('#<label>Response status code</label>\s+500#ms');

    // @todo Figure out why the below test is failing on Drupal.org.
    // Update the remote post handlers insert url to return a 404 error.
    // /** @var \Drupal\webform\Plugin\WebformHandler\RemotePostWebformHandler $handler */
    // $handler = $webform_handler_remote->getHandler('remote_post');
    // $configuration = $handler->getConfiguration();
    // $configuration['settings']['insert_url'] .= '/broken';
    // $handler->setConfiguration($configuration);
    // $webform_handler_remote->save();

    // $this->postSubmission($webform_handler_remote, ['first_name' => 'FAIL']);
    // $this->assertPattern('#<label>Response status code</label>\s+404#ms');
  }

}

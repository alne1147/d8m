<?php
/**
 * @file
 * Contains \Drupal\example\Controller\ExampleController.
 */
namespace Drupal\simple\Controller;
use Drupal\Core\Controller\ControllerBase;

class SimpleStartController {
	public function startAction() {
		return [
			'#markup' => '<h2>Welcome to the start page</h2>',
		];
	}
}

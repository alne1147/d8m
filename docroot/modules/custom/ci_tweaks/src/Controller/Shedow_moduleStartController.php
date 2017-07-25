<?php
/**
 * @file
 * Contains \Drupal\example\Controller\ExampleController.
 */
namespace Drupal\ci_form_tweaks\Controller;
use Drupal\Core\Controller\ControllerBase;

class ci_form_tweaksStartController {
	public function startAction() {
		return [
			'#markup' => '<h2>Welcome to the start page</h2>',
		];
	}
}

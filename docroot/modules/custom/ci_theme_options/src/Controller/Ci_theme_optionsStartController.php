<?php
/**
 * @file
 * Contains \Drupal\example\Controller\ExampleController.
 */
namespace Drupal\ci_theme_options\Controller;
use Drupal\Core\Controller\ControllerBase;

class Ci_theme_optionsStartController {
	public function startAction() {
		return [
			'#markup' => '<h2>Welcome to the start page</h2>',
		];
	}
}

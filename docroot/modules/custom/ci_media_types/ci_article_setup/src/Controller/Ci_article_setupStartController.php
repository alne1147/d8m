<?php
/**
 * @file
 * Contains \Drupal\example\Controller\ExampleController.
 */
namespace Drupal\ci_article_setup\Controller;
use Drupal\Core\Controller\ControllerBase;

class Ci_article_setupStartController {
	public function startAction() {
		return [
			'#markup' => '<h2>Welcome to the start page</h2>',
		];
	}
}

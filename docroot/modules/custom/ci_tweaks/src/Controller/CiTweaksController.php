<?php

namespace Drupal\ci_tweaks\Controller;
use Drupal\Core\Controller\ControllerBase;

class ShedowController extends ControllerBase {
public function __construct() {
}
public function themingPage($number) {
return array(
'#theme' => 'ci_tweaks_page_theme',
'#number' => $number,
);
}
}
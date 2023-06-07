<?php

namespace Themeco\Cornerstone\Controllers;

use Themeco\Cornerstone\Services\Routes;
use Themeco\Cornerstone\Services\Locator as LocatorService;

class Locator {

  public function __construct(Routes $routes, LocatorService $locator) {
    $this->routes = $routes;
    $this->locator = $locator;
  }

  public function setup() {
    $this->routes->add_route('get', 'locator', [$this, 'query']);
    $this->routes->add_route('get', 'locate-attachment', [$this, 'attachment']);
  }

  public function query($data) {
    return $this->locator->query( array_merge( $data, [
      'cs_only' => false
    ] ));
  }

  public function attachment($data) {

    if ( isset( $data['attachment'] ) ) {
      $parts = explode(':', $data['attachment']);

      $atts = [
        'src' => $parts[0],
      ];

      // Just in case it wasn't passed
      if (!empty($parts[1])) {
        $atts['size'] = $parts[1];
      }

      // See functions/helpers
      return cs_apply_image_atts($atts);
    }

    return [ 'url' => '' ];

  }

}

<?php

namespace Themeco\Cornerstone\Util;

use Themeco\Cornerstone\Plugin;

abstract class VersionedUrl {

  protected $ext;

  public function __construct(Plugin $plugin) {
    $this->plugin = $plugin;
    $this->path = $this->plugin->path;
    $this->url = $this->plugin->url;
  }

  public function configure($path, $url) {
    $this->path = $path;
    $this->url = $url;
  }

  public function path($path) {
    return $this->path . '/' . $path;
  }

  public function url($url) {
    return $this->url . '/' . $url;
  }

  public function get( $asset ) {

    $ext = $this->ext;

    if ( ! defined( 'CS_ASSET_REV' ) ) {
      define( 'CS_ASSET_REV', CS_VERSION );
    }

    if (CS_ASSET_REV) {
      // Return matching asset rev file if it exists
      $rev = CS_ASSET_REV;

      $path = "$asset.$rev.$ext";
      $filename = $this->path( $path );

      if (file_exists($filename)) {
        return array(
          'asset_rev' => true,
          'url' => $this->url($path),
          'version' => defined('CS_APP_BUILD_TOOLS') && CS_APP_BUILD_TOOLS ? time() : null
        );
      }
    }

		// Return a unversioned file if it exists
		$basepath = $this->path($asset);
		$unversioned = "$basepath.$ext";

		if (file_exists($unversioned)) {
			return array(
				'unversioned' => true,
				'url' => $this->url("$asset.$ext"),
				'version' => null
			);
		}

		// Try to detect a versioned file that wasn't declared
		$files = glob("$basepath.*.$ext", GLOB_NOSORT);

		if (count($files) > 0) {

			$urlpath = dirname($asset);
			$filename = basename($files[0]);

			return array(
				'versioned' => true,
				'url' => $this->url("$urlpath/$filename"),
				'version' => null
			);
		}

		// If we can't find anything, return a fallback to the exact requested URL even though it will 404
		return array(
			'not_found' => true,
			'url' => $this->url("$asset.$ext"),
			'version' => null
		);
  }

}
<?php
namespace Civi\Test\CiviEnvBuilder;

class SqlFileStep implements StepInterface {
  private $file;

  /**
   * SqlFileStep constructor.
   * @param string $file
   */
  public function __construct($file) {
    $this->file = $file;
  }

  public function getSig() {
    return implode(' ', [
      $this->file,
      filemtime($this->file),
      filectime($this->file),
    ]);
  }

  public function isValid() {
    return is_file($this->file) && is_readable($this->file);
  }

  /**
   * @param \CiviEnvBuilder $ctx
   * @throws \RuntimeException
   */
  public function run($ctx) {
    if (\Civi\Test::execute(@file_get_contents($this->file)) === FALSE) {
      throw new \RuntimeException("Cannot load {$this->file}. Aborting.");
    }
  }

}

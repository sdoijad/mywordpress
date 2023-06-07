<?php

namespace Themeco\Cornerstone\Vm\Types;

class BaseTuple extends Type {

  public static function primitive() {
    return 'tuple';
  }

  public function setTypes($tupleTypes) {
    $this->tupleTypes = $tupleTypes;
    return $this;
  }

}
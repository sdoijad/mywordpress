<?php

namespace Themeco\Cornerstone\Tss\Typed;

class Number extends Typed {

  public function unaryPlus() {
    return $this->setValue(abs($this->value));
  }

  public function unaryMinus() {
    return $this->setValue((float)$this->value * -1);
  }

}

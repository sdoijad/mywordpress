<?php

namespace Themeco\Cornerstone\Parsy\Parsers;

class Regex extends Parser {

  protected $name = 'regex';
  protected $pattern;
  protected $group;

  public function __construct($pattern, $group = 0) {
    $this->pattern = $pattern;
    $this->group = $group;
  }

  public function transform( $state ) {

    if ($state->isError()) return $state;
    $ctx = $state->next();

    $matched = preg_match($this->pattern, $ctx, $matches);

    if (isset($matches[$this->group])) {
      return $this->update($state, $matches[$this->group], strlen($matches[0]));
    }


    return $this->error($state, "Tried to match {$this->pattern} but got $ctx");
  }

}

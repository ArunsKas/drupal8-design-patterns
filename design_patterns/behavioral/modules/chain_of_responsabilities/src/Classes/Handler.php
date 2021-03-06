<?php

namespace Drupal\chain_of_responsabilities\Classes;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Handler {
  /**
   * @var Handler|null
   */
  private $successor = NULL;

  public function __construct(Handler $handler = NULL) {
    $this->successor = $handler;
  }

  /**
   * This approach by using a template method pattern ensures you that
   * each subclass will not forget to call the successor
   *
   * @param RequestInterface $request
   *
   * @return string|null
   */
  final public function handle(RequestInterface $request) {
    $processed = $this->processing($request);

    if ($processed === NULL) {
      // the request has not been processed by this handler => see the next
      if ($this->successor !== NULL) {
        $processed = $this->successor->handle($request);
      }
    }

    return $processed;
  }

  abstract protected function processing(RequestInterface $request);
}

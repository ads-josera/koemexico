<?php

declare(strict_types=1);

namespace Drupal\Tests\permissions_by_term\Kernel;

/**
 * @group permissions_by_term
 */
class AccessStorageTest extends PbtKernelTestBase {

  public function testTidsByNidRetrieval() {
    $this->createRelationOneGrantedTerm();
    /**
     * @var \Drupal\permissions_by_term\Service\TermHandler $termHandler
     */
    $termHandler = \Drupal::service('permissions_by_term.term_handler');

    self::assertCount(3, $termHandler->getTidsByNid('1'));
    self::assertNull($termHandler->getTidsByNid('99'));
  }

}

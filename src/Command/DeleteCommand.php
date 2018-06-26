<?php

namespace Drupal\block_parent_tester\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\ContainerAwareCommand;
use Drupal\Console\Annotations\DrupalCommand;

/**
 * Class DeleteCommand.
 *
 * @DrupalCommand (
 *     extension="block_parent_tester",
 *     extensionType="module"
 * )
 */
class DeleteCommand extends ContainerAwareCommand {

  /**
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $storage;

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('block_parent_tester:delete')
      ->setDescription('delete');
    $this->setAliases(['bpd']);
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->storage = \Drupal::entityTypeManager()->getStorage('block_content');
    while ($blocks = $this->getBlocks()) {
      $this->storage->delete($blocks);
    }
    $this->getIo()->info('Deleted all blocks');
  }

  /**
   *
   * @return \Drupal\Core\Entity\EntityInterface[]
   */
  protected function getBlocks() {
    $query = $this->storage->getQuery();
    $query->range(0, 100);
    if ($block_ids = $query->execute()) {
      return $this->storage->loadMultiple($block_ids);
    }
    return [];
  }
}

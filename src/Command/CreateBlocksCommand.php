<?php

namespace Drupal\block_parent_tester\Command;

use Drupal\block_content\Entity\BlockContent;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\ContainerAwareCommand;
use Drupal\Console\Annotations\DrupalCommand;

/**
 * Class CreateBlocksCommand.
 *
 * @DrupalCommand (
 *     extension="block_parent_tester",
 *     extensionType="module"
 * )
 */
class CreateBlocksCommand extends ContainerAwareCommand {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('block_parent_tester:create_blocks')
      ->setDescription($this->trans('commands.block_parent_tester.create_blocks.description'));
    $this->addArgument('entity_type_id', InputArgument::REQUIRED);
    $this->addArgument('id', InputArgument::REQUIRED);
    $this->addArgument('count', InputArgument::OPTIONAL, '', 100);

    $this->setAliases(['bpc']);
  }

 /**
  * {@inheritdoc}
  */
  protected function initialize(InputInterface $input, OutputInterface $output) {
    parent::initialize($input, $output);
    $this->getIo()->info('initialize');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->getIo()->info('execute');
    $entity_type_id = $input->getArgument('entity_type_id');
    $id = $input->getArgument('id');
    $count = (int) $input->getArgument('count');
    for ($i = 0; $i <= $count; $i++) {
      BlockContent::create([
        'info' => "block $i",
        'body' => "body text $i",
        'type' => 'basic',
        'parent_entity_type' => $entity_type_id,
        'parent_entity_id' => $id,
      ])->save();
    }
    $this->getIo()->info("creating: $entity_type_id $id $count");
  }
}

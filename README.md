
## Block Parent Tester
Apply patch here: https://www.drupal.org/project/drupal/issues/2976334#comment-12663197


## Instructions
1. Enable this module
2. Create entity to be the block parent
3. Create blocks with this entity as parent with this drupal console command `drupal bpc node 12 3000`
4. Delete the parent entity
5. During the deletion `block_parent_tester_entity_delete()` will try to update all the blocks
6. Did it work?

## Thoughts
I site with more block types that have more fields would take longer. I site with many implementations of `hook_entity_update()` would take longer.  



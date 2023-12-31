<?php

namespace Drupal\tracker;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\tracker\Entity\TrackerInterface;

/**
 * Access controller for the Tracker entity.
 */
class TrackerAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var TrackerInterface $entity */
    switch($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view tracker entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit tracker entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete tracker entities');
    }

    // No operation.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add tracker entities');
  }
}

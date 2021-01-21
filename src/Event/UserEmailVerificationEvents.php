<?php

namespace Drupal\user_email_verification\Event;

/**
 * Defines events for the user_email_verification module.
 *
 * @ingroup user_email_verification
 */
final class UserEmailVerificationEvents {

  /**
   * Name of the event fired when a user account is being verify.
   *
   * @Event
   *
   * @see \Drupal\user_email_verification\Event\UserEmailVerificationVerifyEvent
   *
   * @var string
   */
  const VERIFY = 'user_email_verification.verify';

}

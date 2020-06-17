<?php

namespace Drupal\user_email_verification;

use Drupal\user\UserInterface;

/**
 * Interface defining User email verification helper service.
 */
interface UserEmailVerificationInterface {

  /**
   * Table name which contains Email verification data.
   */
  const VERIFICATION_TABLE_NAME = 'user_email_verification';

  /**
   * Queue "Block user account": Quantity of users to block by one queue item.
   */
  const QUEUE_BLOCK_ACCOUNT_LIMIT = 10;

  /**
   * Queue "Remind an user": Quantity of users to remind by one queue item.
   */
  const QUEUE_REMINDERS_LIMIT = 10;

  /**
   * Queue "Delete user account": Quantity of users to delete by one queue item.
   */
  const QUEUE_DELETE_ACCOUNT_LIMIT = 10;

  /**
   * Return email validation interval.
   *
   * @return int
   *   Validate interval time in seconds.
   */
  public function getValidateInterval();

  /**
   * Return quantity of reminders which should be used.
   *
   * @return int
   *   Reminders quantity.
   */
  public function getNumReminders();

  /**
   * Return reminder interval (in seconds).
   *
   * @return int
   *   Reminder interval (in seconds).
   */
  public function getReminderInterval();

  /**
   * Return role names which shouldn't have Email verification.
   *
   * @return array
   *   Role names to skip.
   */
  public function getSkipRoles();

  /**
   * Return extended email validation interval.
   *
   * @return int
   *   Extended validate interval time in seconds.
   */
  public function getExtendedValidateInterval();

  /**
   * Return verification mail subject.
   *
   * @return string
   *   Verification mail subject.
   */
  public function getMailSubject();

  /**
   * Return verification mail body.
   *
   * @return string
   *   Verification mail body.
   */
  public function getMailBody();

  /**
   * Return extended verification mail subject.
   *
   * @return string
   *   Extended verification mail subject.
   */
  public function getExtendedMailSubject();

  /**
   * Return extended verification mail body.
   *
   * @return string
   *   Extended verification mail body.
   */
  public function getExtendedMailBody();

  /**
   * Checks is extended period enabled or no.
   *
   * @return bool
   *   Is extended period enabled or no.
   */
  public function isExtendedPeriodEnabled();

  /**
   * Build a base-64 encoded sha-256 HMAC.
   *
   * @param int $uid
   *   User ID.
   * @param int $timestamp
   *   Timestamp value.
   *
   * @return string
   *   A base-64 encoded sha-256 hmac.
   */
  public function buildHmac($uid, $timestamp);

  /**
   * Build Email verification URL for requested user.
   *
   * @param \Drupal\user\UserInterface $user
   *   User to create email verification URL for.
   *
   * @return \Drupal\Core\Url
   *   Email verification URL.
   */
  public function buildVerificationUrl(UserInterface $user);

  /**
   * Build extended Email verification URL for requested user.
   *
   * @param \Drupal\user\UserInterface $user
   *   User to create email verification URL for.
   *
   * @return \Drupal\Core\Url
   *   Extended Email verification URL.
   */
  public function buildExtendedVerificationUrl(UserInterface $user);

  /**
   * Load verification item for requested user ID.
   *
   * @param int $uid
   *   User ID.
   *
   * @return array|false
   *   Verification item data array on success or boolean FALSE otherwise.
   */
  public function loadVerificationByUserId($uid);

  /**
   * Update verification for requested user: Set email verified.
   *
   * @param int $uid
   *   User ID.
   */
  public function setEmailVerifiedByUserId($uid);

  /**
   * Create user email verification item.
   *
   * @param \Drupal\user\UserInterface $user
   *   User to create email verification item for.
   * @param bool $verify
   *   Flag mark as verified/no on creation.
   */
  public function createVerification(UserInterface $user, $verify = FALSE);

  /**
   * Delete user email verification item.
   *
   * @param \Drupal\user\UserInterface $user
   *   User to delete email verification item for.
   */
  public function deleteVerification(UserInterface $user);

  /**
   * Handle cron related tasks.
   */
  public function cronHandler();

  /**
   * Blocks user account by ID.
   *
   * @param int $uid
   *   User ID.
   */
  public function blockUserAccountById($uid);

  /**
   * Send "Verify your Email" mail to requested user.
   *
   * @param int $uid
   *   User ID.
   *
   * @return bool
   *   Action result.
   */
  public function sendVerifyMailById($uid);

  /**
   * Send "blocked account verified Email" mail to site administrator.
   *
   * @param \Drupal\user\UserInterface $user
   *   Blocked user who verified Email.
   *
   * @return bool
   *   Action result.
   */
  public function sendVerifyBlockedMail(UserInterface $user);

  /**
   * Reminds user about verification user by ID.
   *
   * @param int $uid
   *   User ID.
   */
  public function remindUserById($uid);

  /**
   * Delete user account by ID.
   *
   * @param int $uid
   *   User ID.
   */
  public function deleteUserAccountById($uid);

  /**
   * Checks: Can we remind user right now.
   *
   * @param int $uid
   *   User ID.
   *
   * @return bool
   *   Result of check.
   */
  public function isReminderNeeded($uid);

  /**
   * Checks: Is email verification needed for a requested user.
   *
   * @param int $uid
   *   User ID, optional, if not set - current user ID will be used.
   *
   * @return bool
   *   Result of check.
   */
  public function isVerificationNeeded($uid = 0);

  /**
   * Fill email message with data. A hook_mail() handler.
   *
   * @param string $key
   *   A key to identify the email sent.
   * @param array $message
   *   A message array to be filled in.
   * @param array $params
   *   An array of message parameters.
   */
  public function initEmailMessage($key, array &$message, array $params);

  /**
   * Load Drupal user by name or email.
   *
   * @param string $name_or_email
   *   User name/login or email.
   *
   * @return null|\Drupal\user\UserInterface
   *   Drupal user on success or NULL otherwise.
   */
  public function getUserByNameOrEmail($name_or_email);

}

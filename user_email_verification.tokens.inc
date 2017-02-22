<?php

/**
 * @file
 * Builds placeholder replacement tokens for user-related data.
 */

/**
 * Implements hook_token_info().
 */
function user_email_verification_token_info() {
  $info['tokens']['user']['verify-email'] = array(
    'name' => t('Verify-email URL'),
    'description' => t('The URL to verify the user e-mail.'),
    'restricted' => TRUE,
  );

  $info['tokens']['user']['verify-email-extended'] = array(
    'name' => t('Verify-email extended URL'),
    'description' => t('The URL to verify the user e-mail after initial timeout period.'),
    'restricted' => TRUE,
  );

  return $info;
}

/**
 * Implements hook_tokens().
 */
function user_email_verification_tokens($type, $tokens, array $data = array(), array $options = array()) {
  $sanitize = !empty($options['sanitize']);

  $replacements = array();

  if ($type == 'user' && !empty($data['user'])) {
    $account = $data['user'];
    foreach ($tokens as $name => $original) {
      switch ($name) {
        // Basic user account information.
        case 'verify-email':
          // Let's generate the verify link for this account
          $replacements[$original] = user_email_verification_url($account);
          break;
        case 'verify-email-extended':
          // Let's generate the extended verify link for this account
          $replacements[$original] = user_email_verification_extended_url($account);
          break;
      }
    }
  }

  return $replacements;
}

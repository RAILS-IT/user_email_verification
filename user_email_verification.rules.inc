<?php
/**
 * Implementation of hook_rules_event_info().
 * @ingroup rules
 */
function user_email_verification_rules_event_info() {
  return array(
    'user_email_verification_verified_email' => array(
      'label' => t('Account\'s e-mail verified before timeout'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'user', 'label' => t('User account')),
      ),
    ),
    'user_email_verification_account_reminded' => array(
      'label' => t('Account reminded'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'user', 'label' => t('User account')),
      ),
    ),
    'user_email_verification_account_blocked' => array(
      'label' => t('Account blocked'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'user', 'label' => t('User account')),
      ),
    ),
    'user_email_verification_verified_blocked' => array(
      'label' => t('Account\'s e-mail verified after timeout'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'user', 'label' => t('User account')),
      ),
    ),
    'user_email_verification_verified_extended_before' => array(
      'label' => t('Account\'s e-mail verified before extended timeout'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'user', 'label' => t('User account')),
      ),
    ),
    'user_email_verification_account_deleted' => array(
      'label' => t('Account deleted'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'user', 'label' => t('User account')),
      ),
    ),
    // User account should be deleted at this point, so only uid is available
    'user_email_verification_verified_extended_after' => array(
      'label' => t('User tried to verify e-mail address after extended timeout'),
      'group' => t('E-mail verification'),
      'variables' => array(
        'account' => array('type' => 'integer', 'label' => t('User ID')),
      ),
    ),
  );
}

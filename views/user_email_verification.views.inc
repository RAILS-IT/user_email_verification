<?php

/**
 * Implements hook_views_data()
 */
function user_email_verification_views_data() {

  $data['user_email_verification']['table']['group'] = t('User email verification');

  $data['user_email_verification']['table']['base'] = array(
    'title' => t("User email verification"),
    'help' => t("User email verification"),
    'weight' => 10
  );

  $data['user_email_verification']['verified'] = array(
    'title' => t('Verified'),
    'help' => t('The verified flag.'),
    'field' => array(
      'handler' => 'views_handler_field',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_boolean_operator',
    )
  );

  $data['user_email_verification']['last_reminder'] = array(
    'title' => t('Last reminder'),
    'help' => t('Last notification timestamp.'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort_date',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_date',
    )
  );

  $data['user_email_verification']['reminders'] = array(
    'title' => t('Reminders'),
    'help' => t('Number of reminders sent.'),
    'field' => array(
      'handler' => 'views_handler_field',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    )
  );

  // For other base tables, explain how we join
  $data['user_email_verification']['table']['join'] = array(
    'users' => array(
      'handler' => 'views_join',
      'left_table' => 'users',
      'left_field' => 'uid',
      'field' => 'uid',
    ),
  );

  return $data;
}

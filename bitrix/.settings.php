<?php
return array (
  'utf_mode' => 
  array (
    'value' => true,
    'readonly' => true,
  ),
  'default_charset' => 
  array (
    'value' => false,
    'readonly' => false,
  ),
  'no_accelerator_reset' => 
  array (
    'value' => false,
    'readonly' => false,
  ),
  'http_status' => 
  array (
    'value' => false,
    'readonly' => false,
  ),
  'cache' => 
  array (
    'value' => 
    array (
      'type' => 'files',
    ),
    'readonly' => false,
  ),
  'cache_flags' => 
  array (
    'value' => 
    array (
      'config_options' => 3600,
      'site_domain' => 3600,
    ),
    'readonly' => false,
  ),
  'cookies' => 
  array (
    'value' => 
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' => 
  array (
    'value' => 
    array (
      'debug' => true,
      'handled_errors_types' => 29687,
      'exception_errors_types' => 20853,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => 
      array (
        'settings' => 
        array (
          'file' => 'bitrix/modules/error.log',
          'log_size' => 1000000,
        ),
      ),
    ),
    'readonly' => false,
  ),
  'connections' => 
  array (
    'value' => 
    array (
      'default' => 
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqlConnection',
        'host' => 'localhost',
        'database' => 'dombtcom',
        'login' => 'dombtcom',
        'password' => 'faekziubnu',
        'options' => 2,
      ),
    ),
    'readonly' => true,
  ),
);

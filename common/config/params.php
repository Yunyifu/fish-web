<?php
return array_merge([
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    ],
    ['apiUrl' => 'http://api.fish-web.com',
     'alibc' => [
    'key' => '23833018',
    'secret' => 'dd5cfb27bfaa6c4528daeed11886ad37',
    'wantu' => [
        'ns' => 'dev',
        'expires' => 1 * 3600
    ],],],
    require (__DIR__ . '/system_config.php') );

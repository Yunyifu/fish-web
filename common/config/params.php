<?php
return array_merge([
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
], require (__DIR__ . '/system_config.php') );

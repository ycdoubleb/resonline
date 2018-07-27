<?php

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordAccessTokenExpire' => 3600 * 24 * 7,
    /* 加密安全认证 */
    'secret_auth' => [
        //密钥 认证数据完整性
        'secret' => 'studying8_youxueba',
        //加密数据密钥
        'key' => 'studying8_youxueba_content',
        //起时检测
        'timeout' => 60 * 10,
    ]
];

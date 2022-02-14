<?php

return [
    'key' => env('SMS_DRIVER_API_KEY', ''),
    'uri' => env('SMS_DRIVER_BASE_URL', 'https://rest.ippanel.com/v1/messages'),
    'originator' => env('SMS_DRIVER_ORIGINATOR', '+983000505')
];

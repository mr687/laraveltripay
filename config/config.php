<?php

return [
  'production' => env('TRIPAY_PRODUCTION', false),
  'api_key' => env('TRIPAY_API_KEY', null),
  'private_key' => env('TRIPAY_PRIVATE_KEY', null),
  'merchant_code' => env('TRIPAY_MERCHANT_CODE', null),
];

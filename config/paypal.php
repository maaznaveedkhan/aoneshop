<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    =>'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => 'AfrxDPXTtfbA9qb7VcLl6gG1nd1JmSayt2gl0sjP5rVyhFYiW-9BEq8iB7MKIXH4Zj9Ix_rvxQNKVm46',
        'client_secret'     => 'EF8pc2ms7_danqpw7_qmqm8KNBbJ4VhIEPd1SPYPbwgMc7yh913kMUDwvMjguqcLPgJY2G1nm69zeHAw',
        'app_id'            => 'APP-80W284485P519543T',
    ],


    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Order'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
$provider->setApiCredentials($config);
$provider->getAccessToken();

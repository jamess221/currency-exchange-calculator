<?php

return [

   'base_url' => 'http://www.floatrates.com/daily/{currency}.xml',

   'target_key' => 'targetCurrency',

   'rate_key' => 'exchangeRate',

   //'base_url' => 'https://{currency}.fxexchangerate.com/rss.xml'

   'currencies' => [
       'GBP',
       'USD',
       'EUR',
       'AUD',
       'CAD',
       'JPY'
   ]
];

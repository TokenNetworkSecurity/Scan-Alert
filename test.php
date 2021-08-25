<?php
    $rawaddr_json = file_get_contents('https://api.blockchair.com/bitcoin/dashboards/address/1NquWJMUr4KxfcWxMpPmwcqMQfT3aPX7Ep');
    $rawaddr = json_decode($rawaddr_json, true);
    $total = ($rawaddr['data']['1NquWJMUr4KxfcWxMpPmwcqMQfT3aPX7Ep']['address']['received_usd']);
?>
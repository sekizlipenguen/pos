<?php

use Mews\Pos\Gateways\AbstractGateway;

$templateTitle = 'Refund Order';
require '_config.php';
require '../../template/_header.php';
require '../_header.php';

$ord = $session->get('order') ? $session->get('order') : getNewOrder($baseUrl);

// Refund Order
$order = [
    'id'       => $ord['id'],
    'amount'   => $ord['amount'],
];
$transaction = AbstractGateway::TX_REFUND;
$pos->prepare($order, $transaction);
// Refund Order
$pos->refund();

$response = $pos->getResponse();

require '../../template/_simple_response_dump.php';
require '../../template/_footer.php';

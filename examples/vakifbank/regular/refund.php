<?php

use Mews\Pos\Gateways\AbstractGateway;

require '_config.php';
$templateTitle = 'Refund Order';
require '../../template/_header.php';

$order = $session->get('order') ?: getNewOrder($baseUrl, $ip, $request->get('currency', 'TRY'), $session);
// Refund Order
$order = [
    'id' => $session->get('ref_ret_num'), //ReferenceTransactionId
    'ip' => $request->getClientIp(),
    'amount' => $order['amount'],
];
$transaction = AbstractGateway::TX_REFUND;
$pos->prepare($order, $transaction);

$pos->refund();

$response = $pos->getResponse();
require '../../template/_simple_response_dump.php';
require '../../template/_footer.php';

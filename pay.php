<?php
// 验证必要参数是否存在
if (!isset($_GET['T'], $_GET['O'], $_GET['A'])) {
    die("Error: Missing required payment parameters");
}

// 获取并验证参数
$paymentType = intval($_GET['T']);
$orderId = trim($_GET['O']);
$amount = floatval($_GET['A']);

// 验证支付类型
if (!in_array($paymentType, [1, 2, 3, 4])) {
    die("Error: Invalid payment method type");
}

// 验证订单号格式 (PO开头+14位日期时间+3位毫秒+4位随机字符)
if (!preg_match('/^[A-Z]\d{10}[0-9A-Z]{5}$/', $orderId)) {
    die("Error: Invalid order number format");
}

// 验证金额
if ($amount <= 0) {
    die("Error: Invalid payment amount");
}

// 加载支付配置
$paymentConfig = require_once __DIR__ . '/admin/payment_config.php';

// 定义支付处理映射
$paymentHandlers = [
    1 => ['name' => 'PayPal', 'handler' => 'payment/paypal.php', 'config' => $paymentConfig['paypal']],
    2 => ['name' => 'Credit Card', 'handler' => 'payment/credit_card.php', 'config' => $paymentConfig['credit_card']],
    3 => ['name' => 'Bank Transfer', 'handler' => 'payment/bank_transfer.php', 'config' => $paymentConfig['bank_transfer']],
    4 => ['name' => 'Western Union', 'handler' => 'payment/western_union.php', 'config' => $paymentConfig['western_union']]
];

// 获取当前支付方式配置
$currentPayment = $paymentHandlers[$paymentType];

// 验证处理文件是否存在
if (!file_exists($currentPayment['handler'])) {
    die("Error: Payment method not supported yet");
}

// 传递参数到支付处理页面
$paymentData = [
    'order_id' => $orderId,
    'amount' => $amount,
    'config' => $currentPayment['config'],
    'payment_name' => $currentPayment['name']
];

// 包含支付处理文件
include $currentPayment['handler'];
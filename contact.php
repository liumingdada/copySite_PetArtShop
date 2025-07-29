<?php
// 处理联系表单提交并保存到XML文件
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单数据
    $name = trim($_POST['contact']['name'] ?? '');
    $email = trim($_POST['contact']['email'] ?? '');
    $phone = trim($_POST['contact']['phone'] ?? '');
    $message = trim($_POST['contact']['body'] ?? '');
    
    // 验证必填字段
    $errors = [];
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (empty($message)) {
        $errors[] = 'Message is required.';
    }
    
    if (empty($errors)) {
        // 配置XML文件路径
        $xmlFile = 'admin/data/messages.xml';
        $now = date('Y-m-d H:i:s');
        
        // 创建或加载XML文件
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        if (file_exists($xmlFile)) {
            $dom->load($xmlFile);
            $messagesNode = $dom->documentElement;
        } else {
            // 创建根节点
            $messagesNode = $dom->createElement('messages');
            $dom->appendChild($messagesNode);
        }

        // 创建新留言节点
        $messageNode = $dom->createElement('message');

        // 添加子节点
        $messageNode->appendChild($dom->createElement('timestamp', $now));
        $messageNode->appendChild($dom->createElement('name', htmlspecialchars($name)));
        $messageNode->appendChild($dom->createElement('email', htmlspecialchars($email)));
        $messageNode->appendChild($dom->createElement('phone', htmlspecialchars($phone)));
        $messageNode->appendChild($dom->createElement('body', htmlspecialchars($message)));

        // 将新节点插入到最前面
        if ($messagesNode->firstChild) {
            $messagesNode->insertBefore($messageNode, $messagesNode->firstChild);
        } else {
            $messagesNode->appendChild($messageNode);
        }

        // 保存XML文件
        $dom->save($xmlFile);
        
        // 重定向到成功页面
        header('Location: contact-us.html?success=1#contact_form');
        exit;
    } else {
        // 重定向到错误页面
        $errorStr = implode(' ', $errors);
        header("Location: contact-us.html?error=" . urlencode($errorStr) . "#contact_form");
        exit;
    }
} else {
    // 非POST请求重定向
    header('Location: contact-us.html#contact_form');
    exit;
}
?>
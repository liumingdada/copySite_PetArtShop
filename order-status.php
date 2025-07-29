<?php
// 处理订单查询请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderNumber = trim($_POST['order_number'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if (!empty($orderNumber) && !empty($email)) {
        $xml = simplexml_load_file('admin/data/orders.xml');
        if ($xml) {
            // 使用XPath查询匹配订单号(ID属性)和邮箱的订单
            $orders = $xml->xpath("//order[@id='$orderNumber' and email='$email']");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, height=device-height, viewport-fit=cover">
    <title>Order Status Inquiry</title>
    <link rel="icon" href="static/image/favicon.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="static/css/css2.css" rel="stylesheet">
    <link rel="stylesheet" href="static/css/swiper-bundle.min.css">
    <link href="static/css/theme-global.css" rel="stylesheet">
    <link href="static/css/theme-header.css" rel="stylesheet">
    <link href="static/css/theme-mini-cart.css" rel="stylesheet">
    <link href="static/css/theme-footer.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="static/css/accelerated-checkout-backwards-compat.css" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/font-awesome.min.css">
    <style>
        /* 从contact-us.html复制的货币选择器样式 */
        .nice-select {
            -webkit-tap-highlight-color: transparent;
            background-color: transparent !important;
            border-radius: 0px;
            border-color: inherit !important;
            box-sizing: border-box;
            clear: both;
            cursor: pointer;
            display: block;
            font-family: inherit;
            font-size: inherit;
            font-weight: normal;
            height: 30px;
            line-height: 30px;
            outline: none;
            padding-left: 5px;
            padding-right: 20px;
            position: relative;
            text-align: left !important;
            transition: all 0.2s ease-in-out;
            -webkit-user-select: none;
               -moz-user-select: none;
                -ms-user-select: none;
                    user-select: none;
            white-space: nowrap;
            width: 90px; }
        .nice-select .option {
            cursor: pointer;
            border-bottom: solid 1px #e8e8e8;
            font-weight: 400;
            line-height: 30px !important;
            list-style: none;
            padding-left: 5px;
            text-align: left;
            transition: all 0.2s;
            width: 94px !important;
        }
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .section-title {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }
        .order-form {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            max-width: 700px;
            margin: 0 auto 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            max-width: 700px;
            margin: 0 auto 40px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-group input, .nice-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .submit-btn {
        background-color: #2c3e50; /* 匹配contact-us页面的主色调 */
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #34495e;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #34495e;
        }
        .results-container {
            margin-top: 40px;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .order-table th,
        .order-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .order-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .no-results {
            text-align: center;
            padding: 40px;
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="header-container" >
            <div class="logo" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                <a href="/">
                    
                    <img src="static/image/logo.svg" style="width: auto; height: 60px; vertical-align: middle;" alt="Pet Creations Art Logo">

                </a>
            </div>
            <nav id="headerNav">
            <div class="headerNavLink">
                <a class="headerNavLinkTitle" href="personalised-custom-cartoon-pet-canvas.html">Shop Now</a>
            </div>
            <div class="headerNavLink">
                <a class="headerNavLinkTitle" href="contact-us-customer-reviews.html">Reviews</a>
            </div>
            <div class="headerNavLink">
                <a class="headerNavLinkTitle" href="f-a-q.html">FAQ</a>
            </div>
            <div class="headerNavLink">
                <a class="headerNavLinkTitle" href="contact-us.html">Help</a>
            </div>
        </nav>
            
        </div>
    </header>

    <main class="page-container">
        <h1 class="section-title">Order Status Inquiry</h1>

        <form method="post" class="order-form">
            <div class="form-group">
                <label for="order_number">Order Number</label>
                <input type="text" id="order_number" name="order_number" required placeholder="Enter your order number">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email address">
            </div>
            <button type="submit" class="submit-btn">Check Order Status</button>
        </form>

        <div class="results-container">
            <?php if (!empty($orders)): ?>
                <h2>Order Results (<?php echo count($orders); ?>)</h2>
                <table class="order-table">
                    <tr>
                        <th>Order Number</th>
                        <th>Email</th>
                        <th>Pet Name</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                    </tr>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order->email); ?></td>
                        <td><?php echo htmlspecialchars($order->PetName); ?></td>
                        <td><?php echo htmlspecialchars($order->status); ?></td>
                        <td><?php echo htmlspecialchars($order->order_date); ?></td>
                        <td><?php echo htmlspecialchars($order->amount); ?> USD</td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="no-results">
                    <p>No orders found matching your information.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer">
            <div id="footerTop">
                <div id="footerSocial">
                    <img src="static/image/logo.png" alt="Pet Creations Art" id="footerSocialLogo">
                    <div id="footerSocialLinks">
                        <a href="https://facebook.com" class="footerSocialLinksItem"><i class="fa fa-facebook"></i></a>
                        <a href="https://instagram.com" class="footerSocialLinksItem"><i class="fa fa-instagram"></i></a>
                        <a href="https://pinterest.com" class="footerSocialLinksItem"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
                <nav id="footerNav">
                    <div class="footerNavSection">
                        <h3 class="footerNavSectionTitle">Company</h3>
                        <a href="f-a-q.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">FAQ</div>
                        </a>
                        <a href="contact-us-customer-reviews.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">Reviews</div>
                        </a>
                        <a href="contact-us-about-sallie-and-sophia.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">About Us</div>
                        </a>

<a href="contact-us-how-it-works.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">How it Works</div>
                        </a>
                    </div>
                    <div class="footerNavSection">
                        <h3 class="footerNavSectionTitle">Support</h3>
                        <a href="contact-us.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">Contact Us</div>
                        </a>
                        <a href="order-status.php" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">Order Status</div>
                        </a>
                        <a href="contact-us-before-and-after.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">What Will My Pet Look Like?</div>
                        </a>
                    </div>
                    <div class="footerNavSection">
                        <h3 class="footerNavSectionTitle">Store Policies</h3>
                        <a href="refund-policy.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">Refund Policy</div>
                        </a>
                        <a href="privacy-policy.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">Privacy Policy</div>
                        </a>
                        <a href="terms-of-service.html" class="footerNavSectionLink">
                            <div class="footerNavSectionLinkText">Terms of Service</div>
                        </a>
                    </div>
                </nav>
            </div>
            <div id="footerBottom">
                <div id="footerBottomLegal">
                    &copy; <?php echo date('Y'); ?> Pet Creations Art. All rights reserved.
                </div>
            </div>
        </footer>

    <script src="static/js/swiper-bundle.min.js"></script>
    
    <script defer src="static/js/theme-global.js"></script>
    <script defer src="static/js/theme-header.js"></script>
    
</body>
</html>
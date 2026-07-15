<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
    <title><?php echo e(__('Order Invoice')); ?></title>
    <?php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
        $is_rtl = get_user_lang_direction() === 'rtl';
        $alignEnd = $is_rtl ? 'text-right' : 'text-left';
    ?>
    <?php if($site_favicon): ?>
        <link rel="icon" href="<?php echo e($site_favicon['img_url'] ?? ''); ?>" sizes="40x40" type="icon/png">
    <?php endif; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4,
        .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
        }

        .table.table-items td {
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        th,
        tr,
        td,
        p,
        div {
            line-height: 1.1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }

        .cool-gray {
            color: #6B7280;
        }

        .invoice-logo img {
            width: 200px;
            height: 40px;
        }
    </style>
</head>

<body>
    
    <?php if(get_static_option('site_logo')): ?>
        <div class="invoice-logo">
            <?php
                $logoId = get_static_option('site_logo');
                $imageData = get_attachment_image_by_id($logoId, null, false);
                $logoPath = public_path('assets/uploads/media-uploader/' . ($imageData['path'] ?? ''));
            ?>
            <?php if(!empty($imageData['path']) && file_exists($logoPath)): ?>
                <img src="<?php echo e($logoPath); ?>" alt="Site Logo" style="max-width: 200px;">
            <?php else: ?>
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>

    <table class="table mt-5">
        <tbody>
            <tr>
                <?php if($is_rtl): ?>
                    <td class="border-0 pr-0">
                        <p><?php echo e(__('Order ID')); ?> <strong>#000<?php echo e($order->id); ?></strong></p>
                        <p><?php echo e(__('Invoice ID')); ?> <strong>#<?php echo e($order->invoice_no); ?></strong></p>
                        <p><?php echo e(__('Invoice Date')); ?>: <strong><?php echo e(\Carbon\Carbon::now()->toDateString()); ?></strong></p>
                    </td>
                    <td class="border-0 pl-0" width="70%">
                        <h4 class="text-uppercase text-right">
                            <strong><?php echo e(__('Order Invoice')); ?></strong>
                        </h4>
                    </td>
                <?php else: ?>
                    <td class="border-0 pl-0" width="70%">
                        <h4 class="text-uppercase">
                            <strong><?php echo e(__('Order Invoice')); ?></strong>
                        </h4>
                    </td>
                    <td class="border-0 px-0">
                        <p><?php echo e(__('Order ID')); ?> <strong>#000<?php echo e($order->id); ?></strong></p>
                        <p><?php echo e(__('Invoice ID')); ?> <strong>#<?php echo e($order->invoice_no); ?></strong></p>
                        <p><?php echo e(__('Invoice Date')); ?>: <strong><?php echo e(\Carbon\Carbon::now()->toDateString()); ?></strong></p>
                    </td>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>

    
    <table class="table">
        <thead>
            <tr>
                <?php if($is_rtl): ?>
                    <th class="border-0 pr-0 party-header text-right">
                        <?php echo e(__('Client')); ?>

                    </th>
                    <th class="border-0" width="3%"></th>
                    <th class="border-0 pl-0 party-header text-right" width="48.5%">
                        <?php echo e(__('Freelancer')); ?>

                    </th>
                <?php else: ?>
                    <th class="border-0 pl-0 party-header text-left" width="48.5%">
                        <?php echo e(__('Freelancer')); ?>

                    </th>
                    <th class="border-0" width="3%"></th>
                    <th class="border-0 px-0 party-header text-left">
                        <?php echo e(__('Client')); ?>

                    </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if($is_rtl): ?>
                    <td class="px-0 text-right">
                        <?php if($order?->user->fullname): ?>
                            <p class="buyer-name ">
                                <strong><?php echo e($order?->user->fullname); ?></strong>
                            </p>
                        <?php endif; ?>
                    </td>
                    <td class="border-0"></td>
                    <td class="px-0">
                        <?php if($order?->freelancer->fullname): ?>
                            <p class="seller-name text-right">
                                <strong><?php echo e($order?->freelancer->fullname); ?></strong>
                            </p>
                        <?php endif; ?>
                    </td>
                <?php else: ?>
                    <td class="pl-0">
                        <?php if($order?->freelancer->fullname): ?>
                            <p class="seller-name text-left">
                                <strong><?php echo e($order?->freelancer->fullname); ?></strong>
                            </p>
                        <?php endif; ?>
                    </td>
                    <td class="border-0"></td>
                    <td class="pl-0">
                        <?php if($order?->user->fullname): ?>
                            <p class="buyer-name text-left">
                                <strong><?php echo e($order?->user->fullname); ?></strong>
                            </p>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>

    
    <table class="table table-items">
        <thead>
            <tr>
                <?php if($is_rtl): ?>
                    <th scope="col" class="border-0 pr-0 amount-cell"><?php echo e(__('Sub total')); ?></th>
                    <th scope="col" class="border-0 pr-0 text-right"><?php echo e(__('Price')); ?></th>
                    <th scope="col" class="border-0 pr-0 text-right"><?php echo e(__('Quantity')); ?></th>
                    <th scope="col" class="border-0 pl-0 text-right"><?php echo e(__('Description')); ?></th>
                <?php else: ?>
                    <th scope="col" class="border-0 pl-0"><?php echo e(__('Description')); ?></th>
                    <th scope="col" class="border-0 pl-0"><?php echo e(__('Quantity')); ?></th>
                    <th scope="col" class="border-0 pl-0"><?php echo e(__('Price')); ?></th>
                    <th scope="col" class="border-0 px-0 text-right amount-cell"><?php echo e(__('Sub total')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <?php if($is_rtl): ?>
                    <td class="pr-0 amount-cell">
                        <?php echo e(float_amount_with_currency_symbol($order->price - ($order->transaction_amount + $order->commission_amount))); ?>

                    </td>
                    <td class="pr-0 text-right">
                        <?php echo e(float_amount_with_currency_symbol($order->price - ($order->transaction_amount + $order->commission_amount))); ?>

                    </td>
                    <td class="pr-0 text-right">1</td>
                    <td class="pl-0 text-right">
                        <p class="cool-gray">
                            <?php echo e(__('Order Date:')); ?> <?php echo e($order->created_at->toFormattedDateString()); ?> <br>
                            <?php echo e(__('Payment Gateway:')); ?>

                            <?php if($order->payment_gateway == 'manual_payment'): ?>
                                <?php echo e(ucfirst(str_replace('_', ' ', $order->payment_gateway))); ?>

                            <?php else: ?>
                                <?php echo e($order->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($order->payment_gateway)); ?>

                            <?php endif; ?>
                        </p>
                    </td>
                <?php else: ?>
                    <td class="pl-0">
                        <p class="cool-gray">
                            <?php echo e(__('Order Date:')); ?> <?php echo e($order->created_at->toFormattedDateString()); ?> <br>
                            <?php echo e(__('Payment Gateway:')); ?>

                            <?php if($order->payment_gateway == 'manual_payment'): ?>
                                <?php echo e(ucfirst(str_replace('_', ' ', $order->payment_gateway))); ?>

                            <?php else: ?>
                                <?php echo e($order->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($order->payment_gateway)); ?>

                            <?php endif; ?>
                        </p>
                    </td>
                    <td class="pl-0">1</td>
                    <td class="pl-0">
                        <?php echo e(float_amount_with_currency_symbol($order->price - ($order->transaction_amount + $order->commission_amount))); ?>

                    </td>
                    <td class="pr-0 text-right amount-cell">
                        <?php echo e(float_amount_with_currency_symbol($order->price - ($order->transaction_amount + $order->commission_amount))); ?>

                    </td>
                <?php endif; ?>
            </tr>
            
            <tr>
                <?php if($is_rtl): ?>
                    <td class="pr-0 amount-cell"><?php echo e(float_amount_with_currency_symbol($order->transaction_amount)); ?>

                    </td>
                    <td class="pl-0 text-right"><?php echo e(__('Transaction fee')); ?></td>
                    <td colspan="2" class="border-0 text-right"></td>
                <?php else: ?>
                    <td colspan="2" class="border-0"></td>
                    <td class="pl-0"><?php echo e(__('Transaction fee')); ?></td>
                    <td class="pr-0 text-right amount-cell">
                        <?php echo e(float_amount_with_currency_symbol($order->transaction_amount)); ?>

                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if($is_rtl): ?>
                    <td class="pr-0 amount-cell"><?php echo e(float_amount_with_currency_symbol($order->commission_amount)); ?>

                    </td>
                    <td class="pl-0 text-right"><?php echo e(__('Commission amount')); ?></td>
                    <td colspan="2" class="border-0 text-right"></td>
                <?php else: ?>
                    <td colspan="2" class="border-0"></td>
                    <td class="pl-0"><?php echo e(__('Commission amount')); ?></td>
                    <td class="pr-0 text-right amount-cell">
                        <?php echo e(float_amount_with_currency_symbol($order->commission_amount)); ?>

                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if($is_rtl): ?>
                    <td class="pr-0 amount-cell total-amount"><?php echo e(float_amount_with_currency_symbol($order->price)); ?>

                    </td>
                    <td class="pl-0 text-right"><?php echo e(__('Total amount')); ?></td>
                    <td colspan="2" class="border-0 text-right"></td>
                <?php else: ?>
                    <td colspan="2" class="border-0"></td>
                    <td class="pl-0"><?php echo e(__('Total amount')); ?></td>
                    <td class="pr-0 text-right amount-cell total-amount">
                        <?php echo e(float_amount_with_currency_symbol($order->price)); ?>

                    </td>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="<?php echo e($alignEnd); ?>">
        <?php echo e(__('Amount in words')); ?>: <?php echo e(\Terbilang::make($order->price)); ?>

    </p>

    <?php if($order->description): ?>
        <p class="<?php echo e($alignEnd); ?>">
            <?php echo e(__('Notes')); ?>: <?php echo e(__(Str::limit($order->description, 300)) ?? ''); ?>

        </p>
    <?php endif; ?>
</body>

</html>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/order/order-invoice.blade.php ENDPATH**/ ?>
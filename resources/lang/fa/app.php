<?php

use App\Models\Invoice;

return [
    'status' => [
        'not_done' => 'انجام نشده',
        'notwork' => 'انجام نشده',
        'delayed' => 'به‌تعویق افتاده',
        'in_progress' => 'در حال انجام',
        'done' => 'به‌اتمام رسیده',
        'paid' => 'تسویه شده',
    ],
    'invoice_status' => [
        Invoice::STATE_UNPAID => 'در انتظار پرداخت',
        Invoice::STATE_PAYING => 'در حال پرداخت',
        Invoice::STATE_PAID => 'پرداخت‌شده',
        Invoice::STATE_FAILED => 'با خطا مواجه شده',
    ]
];

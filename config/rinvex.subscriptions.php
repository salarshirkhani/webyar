<?php

declare(strict_types=1);

return [

    // Manage autoload migrations
    'autoload_migrations' => false,

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \Rinvex\Subscriptions\Models\Plan::class,
        'plan_feature' => \Rinvex\Subscriptions\Models\PlanFeature::class,
        'plan_subscription' => \App\PlanSubscription::class,
        'plan_subscription_usage' => \App\PlanSubscriptionUsage::class,

    ],

];

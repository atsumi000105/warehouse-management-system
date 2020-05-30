<?php

use App\Entity\Partner;

$container->loadFromExtension('framework', [
    'workflows' => [
        'partner_management' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                Partner::class,
            ],
            'initial_marking' => Partner::STATUS_START,
            'places' => [
                Partner::STATUS_START,
                Partner::STATUS_APPLICATION_PENDING,
                Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                Partner::STATUS_ACTIVE,
                Partner::STATUS_NEEDS_PROFILE_REVIEW,
                Partner::STATUS_REVIEW_PAST_DUE,
                Partner::STATUS_INACTIVE,
            ],
            'transitions' => [
                'submit' => [
                    'from' => [
                        Partner::STATUS_START,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_APPLICATION_PENDING,
                ],
                'submit_priority' => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                ],
                'activate' => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_ACTIVE,
                ],
                'flag_for_review' => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_REVIEW_PAST_DUE,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_NEEDS_PROFILE_REVIEW,
                ],
                'flag_for_review_past_due' => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_REVIEW_PAST_DUE,
                ],
                'deactivate' => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Partner::STATUS_INACTIVE,
                ],
            ],
        ],
    ],
]);

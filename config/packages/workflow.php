<?php

use App\Entity\Client;
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
                Partner::TRANSITION_SUBMIT => [
                    'from' => [
                        Partner::STATUS_START,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_APPLICATION_PENDING,
                    'metadata' => [
                        'title' => 'Submit'
                    ],
                ],
                Partner::TRANSITION_SUBMIT_PRIORITY => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                    'metadata' => [
                        'title' => 'Submit (Priority)'
                    ],
                ],
                Partner::TRANSITION_ACTIVATE => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_ACTIVE,
                    'metadata' => [
                        'title' => 'Activate'
                    ],
                ],
                Partner::TRANSITION_FLAG_FOR_REVIEW => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_REVIEW_PAST_DUE,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_NEEDS_PROFILE_REVIEW,
                    'metadata' => [
                        'title' => 'Flag for Review'
                    ],
                ],
                Partner::TRANSITION_FLAG_FOR_REVIEW_PAST_DUE => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_INACTIVE,
                    ],
                    'metadata' => [
                        'title' => 'Flag for Review Past Due'
                    ],
                   'to' => Partner::STATUS_REVIEW_PAST_DUE,
                ],
                Partner::TRANSITION_DEACTIVATE => [
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Partner::STATUS_INACTIVE,
                    'metadata' => [
                        'title' => 'Deactivate'
                    ],
                ],
            ],
        ],
        'client_management' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                Client::class,
            ],
            'initial_marking' => Client::STATUS_CREATION,
            'places' => [
                Client::STATUS_CREATION,
                Client::STATUS_ACTIVE,
                Client::STATUS_INACTIVE,
                Client::STATUS_LIMIT_REACHED,
                Client::STATUS_DUPLICATE_INACTIVE,
            ],
            'transitions' => [
                Client::TRANSITION_ACTIVATE => [
                    'from' => [
                        Client::STATUS_CREATION,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_LIMIT_REACHED,
                        Client::STATUS_DUPLICATE_INACTIVE,
                    ],
                    'to' => Client::STATUS_ACTIVE,
                    'metadata' => [
                        'title' => 'Activate'
                    ],
                ],
                Client::TRANSITION_DEACTIVATE => [
                    'from' => [
                        Client::STATUS_CREATION,
                        Client::STATUS_ACTIVE,
                        Client::STATUS_LIMIT_REACHED,
                        Client::STATUS_DUPLICATE_INACTIVE,
                    ],
                    'to' => Client::STATUS_INACTIVE,
                    'metadata' => [
                        'title' => 'Deactivate'
                    ],
                ],
                Client::TRANSITION_EXPIRE => [
                    'from' => [
                        Client::STATUS_CREATION,
                        Client::STATUS_ACTIVE,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_DUPLICATE_INACTIVE,
                    ],
                    'to' => Client::STATUS_LIMIT_REACHED,
                    'metadata' => [
                        'title' => 'Expire Client'
                    ],
                ],
                Client::TRANSITION_DUPLICATE_INACTIVE => [
                    'from' => [
                        Client::STATUS_CREATION,
                        Client::STATUS_ACTIVE,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_LIMIT_REACHED,
                    ],
                    'to' => Client::STATUS_DUPLICATE_INACTIVE,
                    'metadata' => [
                        'title' => 'Duplicate (inactivate)'
                    ],
                ],
            ],
        ],
    ],
]);

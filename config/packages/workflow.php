<?php

use App\Entity\Client;
use App\Entity\Orders\AdjustmentOrder;
use App\Entity\Orders\BulkDistribution;
use App\Entity\Orders\MerchandiseOrder;
use App\Entity\Orders\PartnerOrder;
use App\Entity\Orders\SupplyOrder;
use App\Entity\Orders\TransferOrder;
use App\Entity\Partner;

$container->loadFromExtension('framework', [
    'workflows' => [
        'adjustment_order' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                AdjustmentOrder::class,
            ],
            'initial_marking' => AdjustmentOrder::STATUS_CREATING,
            'places' => AdjustmentOrder::STATUSES,
            'transitions' => [
                AdjustmentOrder::TRANSITION_COMPLETE => [
                    'metadata' => [
                        'title' => 'Complete'
                    ],
                    'from' => [
                        AdjustmentOrder::STATUS_CREATING
                    ],
                    'to' => AdjustmentOrder::STATUS_COMPLETED,
                ],
            ],
        ],
        'bulkdistribution_order' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                BulkDistribution::class,
            ],
            'initial_marking' => BulkDistribution::STATUS_CREATING,
            'places' => BulkDistribution::STATUSES,
            'transitions' => [
                BulkDistribution::STATUS_PENDING => [
                    'metadata' => [
                        'title' => 'Mark As Pending'
                    ],
                    'from' => [
                        BulkDistribution::STATUS_CREATING,
                    ],
                    'to' => BulkDistribution::STATUS_PENDING,
                ],
                BulkDistribution::TRANSITION_COMPLETE => [
                    'metadata' => [
                        'title' => 'Complete'
                    ],
                    'from' => [
                        BulkDistribution::STATUS_PENDING,
                    ],
                    'to' => BulkDistribution::STATUS_COMPLETED,
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
                Client::STATUS_ACTIVE,
                Client::STATUS_CREATION,
                Client::STATUS_INACTIVE,
                Client::STATUS_INACTIVE_BLOCKED,
                Client::STATUS_INACTIVE_DUPLICATE,
                Client::STATUS_INACTIVE_EXPIRED,
                Client::STATUS_NEEDS_REVIEW,
                Client::STATUS_REVIEW_PAST_DUE,
            ],
            'transitions' => [
                Client::TRANSITION_ACTIVATE => [
                    'metadata' => [
                        'title' => 'Activate'
                    ],
                    'from' => [
                        Client::STATUS_CREATION,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_INACTIVE_BLOCKED,
                        Client::STATUS_INACTIVE_DUPLICATE,
                        Client::STATUS_INACTIVE_EXPIRED,
                        Client::STATUS_NEEDS_REVIEW,
                        Client::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Client::STATUS_ACTIVE,
                ],
                Client::TRANSITION_DEACTIVATE => [
                    'metadata' => [
                        'title' => 'Deactivate'
                    ],
                    'from' => [
                        Client::STATUS_ACTIVE,
                        Client::STATUS_CREATION,
                        Client::STATUS_INACTIVE_BLOCKED,
                        Client::STATUS_INACTIVE_DUPLICATE,
                        Client::STATUS_INACTIVE_EXPIRED,
                    ],
                    'to' => Client::STATUS_INACTIVE,
                ],
                Client::TRANSITION_DEACTIVATE_EXPIRE => [
                    'metadata' => [
                        'title' => 'Deactivate (Expire Client)'
                    ],
                    'from' => [
                        Client::STATUS_ACTIVE,
                        Client::STATUS_CREATION,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_INACTIVE_DUPLICATE,
                    ],
                    'to' => Client::STATUS_INACTIVE_EXPIRED,
                ],
                Client::TRANSITION_DEACTIVATE_DUPLICATE => [
                    'metadata' => [
                        'title' => 'Deactivate (Duplicate)'
                    ],
                    'from' => [
                        Client::STATUS_ACTIVE,
                        Client::STATUS_CREATION,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_INACTIVE_EXPIRED,
                    ],
                    'to' => Client::STATUS_INACTIVE_DUPLICATE,
                ],
                Client::TRANSITION_FLAG_FOR_REVIEW => [
                    'metadata' => [
                        'title' => 'Needs Review'
                    ],
                    'from' => [
                        Client::STATUS_ACTIVE,
                    ],
                    'to' => Client::STATUS_NEEDS_REVIEW,
                ],
                Client::TRANSITION_FLAG_FOR_REVIEW_PAST_DUE => [
                    'metadata' => [
                        'title' => 'Review Past Due'
                    ],
                    'from' => [
                        Client::STATUS_NEEDS_REVIEW,
                    ],
                    'to' => Client::STATUS_REVIEW_PAST_DUE,
                ],
                Client::TRANSITION_DEACTIVATE_BLOCKED => [
                    'metadata' => [
                        'title' => 'Deactivate (Blocked)'
                    ],
                    'from' => [
                        Client::STATUS_ACTIVE,
                        Client::STATUS_CREATION,
                        Client::STATUS_INACTIVE,
                        Client::STATUS_INACTIVE_DUPLICATE,
                        Client::STATUS_INACTIVE_EXPIRED,
                        Client::STATUS_NEEDS_REVIEW,
                        Client::STATUS_REVIEW_PAST_DUE
                    ],
                    'to' => Client::STATUS_INACTIVE_BLOCKED,
                ],
            ],
        ],
        'merchandise_order' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                MerchandiseOrder::class,
            ],
            'initial_marking' => MerchandiseOrder::STATUS_CREATING,
            'places' => MerchandiseOrder::STATUSES,
            'transitions' => [
                MerchandiseOrder::TRANSITION_COMPLETE => [
                    'metadata' => [
                        'title' => 'Complete'
                    ],
                    'from' => [
                        MerchandiseOrder::STATUS_CREATING
                    ],
                    'to' => MerchandiseOrder::STATUS_COMPLETED,
                ],
            ],
        ],
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
                Partner::STATUS_ACTIVE,
                Partner::STATUS_APPLICATION_PENDING,
                Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                Partner::STATUS_INACTIVE,
                Partner::STATUS_NEEDS_PROFILE_REVIEW,
                Partner::STATUS_REVIEW_PAST_DUE,
                Partner::STATUS_START,
            ],
            'transitions' => [
                Partner::TRANSITION_SUBMIT => [
                    'metadata' => [
                        'title' => 'Submit'
                    ],
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_INACTIVE,
                        Partner::STATUS_START,
                    ],
                    'to' => Partner::STATUS_APPLICATION_PENDING,
                ],
                Partner::TRANSITION_SUBMIT_PRIORITY => [
                    'metadata' => [
                        'title' => 'Submit (Priority)'
                    ],
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_INACTIVE,
                    ],
                    'to' => Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                ],
                Partner::TRANSITION_ACTIVATE => [
                    'metadata' => [
                        'title' => 'Activate'
                    ],
                    'from' => [
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_INACTIVE,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Partner::STATUS_ACTIVE,
                ],
                Partner::TRANSITION_REVIEWED => [
                    'metadata' => [
                        'title' => 'Reviewed'
                    ],
                    'from' => [
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Partner::STATUS_ACTIVE,
                ],
                Partner::TRANSITION_FLAG_FOR_REVIEW => [
                    'metadata' => [
                        'title' => 'Flag for Review'
                    ],
                    'from' => [
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_INACTIVE,
                        Partner::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Partner::STATUS_NEEDS_PROFILE_REVIEW,
                ],
                Partner::TRANSITION_FLAG_FOR_REVIEW_PAST_DUE => [
                    'metadata' => [
                        'title' => 'Flag for Review Past Due'
                    ],
                    'from' => [
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_INACTIVE,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                    ],
                    'to' => Partner::STATUS_REVIEW_PAST_DUE,
                ],
                Partner::TRANSITION_DEACTIVATE => [
                    'metadata' => [
                        'title' => 'Deactivate'
                    ],
                    'from' => [
                        Partner::STATUS_ACTIVE,
                        Partner::STATUS_APPLICATION_PENDING,
                        Partner::STATUS_APPLICATION_PENDING_PRIORITY,
                        Partner::STATUS_NEEDS_PROFILE_REVIEW,
                        Partner::STATUS_REVIEW_PAST_DUE,
                    ],
                    'to' => Partner::STATUS_INACTIVE,
                ],
            ],
        ],
        'partner_order' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                PartnerOrder::class,
            ],
            'initial_marking' => PartnerOrder::STATUS_CREATING,
            'places' => PartnerOrder::STATUSES,
            'transitions' => [
                PartnerOrder::TRANSITION_SUBMIT => [
                    'metadata' => [
                        'title' => 'Submit',
                    ],
                    'from' => [
                        PartnerOrder::STATUS_CREATING,
                    ],
                    'to' => PartnerOrder::STATUS_SUBMITTED,
                ],
                PartnerOrder::TRANSITION_ACCEPT => [
                    'metadata' => [
                        'title' => 'Accept',
                    ],
                    'from' => [
                        PartnerOrder::STATUS_COMPLETED,
                        PartnerOrder::STATUS_SUBMITTED,
                    ],
                    'to' => PartnerOrder::STATUS_IN_PROCESS,
                ],
                PartnerOrder::TRANSITION_COMPLETE => [
                    'metadata' => [
                        'title' => 'Ship'
                    ],
                    'from' => [
                        PartnerOrder::STATUS_IN_PROCESS,
                    ],
                    'to' => PartnerOrder::STATUS_COMPLETED,
                ],
                PartnerOrder::TRANSITION_REVERT_TO_CREATING => [
                    'metadata' => [
                        'title' => 'Revert To Creating'
                    ],
                    'from' => [
                        PartnerOrder::STATUS_IN_PROCESS,
                    ],
                    'to' => PartnerOrder::STATUS_CREATING,
                ],
            ],
        ],
        'supply_order' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                SupplyOrder::class,
            ],
            'initial_marking' => SupplyOrder::STATUS_CREATING,
            'places' => SupplyOrder::STATUSES,
            'transitions' => [
                SupplyOrder::TRANSITION_ORDER => [
                    'metadata' => [
                        'title' => 'Order',
                    ],
                    'from' => [
                        SupplyOrder::STATUS_CREATING,
                    ],
                    'to' => SupplyOrder::STATUS_ORDERED,
                ],
                SupplyOrder::TRANSITION_RECEIVE => [
                    'metadata' => [
                        'title' => 'Receive',
                    ],
                    'from' => [
                        SupplyOrder::STATUS_ORDERED,
                    ],
                    'to' => SupplyOrder::STATUS_RECEIVED,
                ],
                SupplyOrder::TRANSITION_COMPLETE => [
                    'metadata' => [
                        'title' => 'Complete'
                    ],
                    'from' => [
                        SupplyOrder::STATUS_RECEIVED,
                    ],
                    'to' => SupplyOrder::STATUS_COMPLETED,
                ],
            ],
        ],
        'transfer_order' => [
            'type' => 'state_machine',
            'audit_trail' => [
                'enabled' => true,
            ],
            'marking_store' => [
                'type' => 'method',
                'property' => 'status',
            ],
            'supports' => [
                TransferOrder::class,
            ],
            'initial_marking' => TransferOrder::STATUS_CREATING,
            'places' => TransferOrder::STATUSES,
            'transitions' => [
                TransferOrder::TRANSITION_COMPLETE => [
                    'metadata' => [
                        'title' => 'Complete'
                    ],
                    'from' => [
                        TransferOrder::STATUS_CREATING
                    ],
                    'to' => TransferOrder::STATUS_COMPLETED,
                ],
            ],
        ],
    ],
]);

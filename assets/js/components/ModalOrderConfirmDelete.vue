<template>
    <hb-modal :confirmAction="action" classes="modal-danger" id="confirmModal">
        <template slot="header">Delete Order</template>
        <p>Are you sure you want to delete <strong>{{orderTitle}}</strong>?</p>
        <template slot="confirmButton">Delete Order</template>
    </hb-modal>
</template>

<script>
    export default {
        props: {
            action: { type: Function },
            orderTitle: {type: String },
        },
    }
</script>
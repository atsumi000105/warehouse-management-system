<template>
    <hb-modal :confirmAction="action" classes="modal-danger" id="bulkDeleteModal">
        <template slot="header">Bulk {{ bulkDeleteType }}</template>
        <p>Are you sure you want to bulk {{ bulkDeleteType }} the following <strong>{{items.length}}</strong> <strong>{{itemType}}</strong>?</p>
        <ul>
            <li v-for="item in items" v-text="item"></li>
        </ul>
        <template slot="confirmButton">Bulk {{ bulkDeleteType }}</template>
    </hb-modal>
</template>

<script>
    export default {
        props: {
            action: { type: Function },
            itemType: { type: String, default: 'orders' },
            items: { type: Array },
            bulkDeleteType: { type: String, default: 'delete' }
        },
    }
</script>
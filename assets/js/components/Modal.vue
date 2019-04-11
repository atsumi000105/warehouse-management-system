<template>
    <div :class="'modal fade ' + this.classes" :id="this.id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><slot name="header"></slot></h4>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" v-bind:class="{ 'pull-left': hasAction}" data-dismiss="modal"><slot name="cancelButton">Cancel</slot></button>
                    <button type="button" class="btn btn-outline" v-bind:class="{ 'disabled': !confirmEnabled }" v-on:click.prevent="onConfirm" v-if="hasAction" :disabled="!confirmEnabled"><strong><slot name="confirmButton"></slot></strong></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    export default {
        props: {
            classes: { type: String },
            confirmAction: { type: Function },
            id: { type: String },
            hasAction: { type: Boolean, default: true },
            confirmEnabled: { type: Boolean, default: true },
        },

        data: function() {
            return {}
        },
        methods: {
            onConfirm: function() {
                if (this.confirmAction() === false) {
                    return;
                }
                $('#'+this.id).modal('hide');
            }
        }
    }
</script>
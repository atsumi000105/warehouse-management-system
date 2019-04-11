<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    v-if="editable"
                    apiPath="warehouses/list-options"
                    v-model="value"
                    displayProperty="title"
                    emptyString="-- Select Warehouse --"
            ></hb-optionlist>
            <span v-else v-text="value.title"></span>
            <!-- text input -->
        </div>
        <div class="form-group" v-if="!editable">
            <hb-address v-model="value.address"></hb-address>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            v: { type: Object }
        }
    }
</script>
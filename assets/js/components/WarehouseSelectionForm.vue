<template>
    <div>
        <div class="form-group">
            <optionlist
                v-if="editable"
                v-model="value"
                api-path="warehouses/list-options"
                display-property="title"
                empty-string="-- Select Warehouse --"
            />
            <span
                v-else
                v-text="value.title"
            />
            <!-- text input -->
        </div>
        <div
            v-if="!editable"
            class="form-group"
        >
            <address-view v-model="value.address" />
        </div>
    </div>
</template>

<script>
    import Address from '../components/AddressView.vue';
    import OptionList from '../components/OptionList.vue';

    export default {
        components: {
            'address-view' : Address,
            'optionlist' : OptionList
        }, 
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            v: { type: Object }
        }
    }
</script>

<template>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <div
                class="box-title"
                v-text="label"
            />
        </div>
        <div v-if="canEdit" class="box-body">
            <AddressFormFields
                v-model="value"
                :has-title="false"
            />
        </div>
        <div v-else>
            {{ getFullAddress(value) }}
        </div>
    </div>
</template>

<script>
    import AddressFormFields from "./AddressFormFields";

    export default {
        name: "AddressField",

        components: {
            AddressFormFields,
        },

        props: {
            label: {
                type: String,
                required: false,
            },
            value: {
                type: Object,
                required: true,
            },
            canEdit: {
                type: Boolean,
                required:false,
                default: false,
            },
        },

        methods: {
            getFullAddress: function(v) {
                let address = '';

                if (v.steet1) {
                    address = address + ' ' + v.steet1 + ', ';
                }

                if (v.street2) {
                    address = address + ' ' + v.street2 + ', ';
                }

                return address + v.city + ', ' + v.state + ', ' + v.postalCode + ', ' + v.country;
            },
        },
    };
</script>

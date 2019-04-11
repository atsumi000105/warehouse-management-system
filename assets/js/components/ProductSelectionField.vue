<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    label="Product:"
                    v-if="editable"
                    :preloadedOptions="allActiveProducts"
                    v-model="value"
                    displayProperty="name"
                    emptyString="-- Select Product --"
                    ref="productSelect"
            ></hb-optionlist>
            <span v-else v-text="value.title"></span>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            v: { type: Object }
        },
        computed: mapGetters([
            'allActiveProducts'
        ]),
        methods: {
            onSelectionChange: function (eventData) {
                this.$emit('change', eventData);
            }
        },
        mounted: function () {
            this.$store.dispatch('loadProducts');
            this.$refs.productSelect.$on('change', eventData => this.onSelectionChange(eventData))
        }
    }
</script>
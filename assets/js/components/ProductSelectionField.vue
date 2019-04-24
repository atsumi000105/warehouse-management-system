<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    v-if="editable"
                    ref="productSelect"
                    v-model="value"
                    label="Product:"
                    :preloaded-options="allActiveProducts"
                    display-property="name"
                    empty-string="-- Select Product --"
            />
            <span
                v-else
                v-text="value.title"
            />
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
        mounted: function () {
            this.$store.dispatch('loadProducts');
            this.$refs.productSelect.$on('change', eventData => this.onSelectionChange(eventData))
        },
        methods: {
            onSelectionChange: function (eventData) {
                this.$emit('change', eventData);
            }
        }
    }
</script>
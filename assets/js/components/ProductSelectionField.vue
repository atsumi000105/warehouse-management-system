<template>
    <div>
        <optionlist
            v-if="editable"
            ref="productSelect"
            v-model="value"
            :label="label"
            :preloaded-options="allActiveProducts"
            display-property="name"
            empty-string="-- Select Product --"
        />
        <span
            v-else
            v-text="value.title"
        />
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import OptionListEntity from './OptionListEntity';
    export default {
        components: {
            'optionlist' : OptionListEntity
        },
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            label: { type: [String, Boolean], default: "Product:"},
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

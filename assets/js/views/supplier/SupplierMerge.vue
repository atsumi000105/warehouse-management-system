<template>
    <hb-modal
        id="supplierMergeModal"
        classes="modal-info"
        :confirmAction="mergeSuppliers"
        :confirmEnabled="isTargetSet()"
    >
        <template slot="header">Merge Suppliers</template>

        <hb-optionliststatic
                label="Merge suppliers in to"
                v-model="targetSupplier"
                displayProperty="title"
                :displayTextFn="item => item.id + ': ' + item.title"
                property="id"
                :preloadedOptions="selectedSuppliers"
                emptyString="-- Select a Destination Supplier --"
                :chosen="false"
        ></hb-optionliststatic>

        <template v-if="isTargetSet()">
            <div class="form-group">
                <div class="checkbox">
                    <label for="addresses"><input type="checkbox" v-model="mergeContext" value="addresses" id="addresses">Merge Addresses</label>
                </div>
                <div class="checkbox">
                    <label for="contacts"><input type="checkbox" v-model="mergeContext" value="contacts" id="contacts">Merge Contacts</label>
                </div>
                <div class="checkbox">
                    <label for="orders"><input type="checkbox" v-model="mergeContext" value="orders" id="orders">Merge Supply Orders</label>
                </div>
                <div class="checkbox">
                    <label for="orders"><input type="checkbox" v-model="mergeContext" value="deactivate" id="deactivate">Deactivate the merged {{selectedSupplierList.length}} supplier(s)</label>
                </div>
            </div>
            Merge the following suppliers in to <strong>{{targetSupplier.id}} - {{targetSupplierTitle}}</strong>
            <ul>
                <li v-for="supplier in selectedSupplierList" v-text="supplier"></li>
            </ul>
        </template>

        <template slot="confirmButton">Merge</template>
    </hb-modal>
</template>


<script>
    export default {
        name: 'SupplierMerge',
        props: {
            selectedSupplierIds: { type: Array, required: true }
        },
        data() {
            return {
                targetSupplier: {},
                mergeContext: ['orders', 'deactivate'],
            };
        },
        computed: {
            selectedSuppliers: function () {
                let me = this;
                return this.selectedSupplierIds.map(supplierId => me.$store.getters.getSupplierById(supplierId));
            },
            targetSupplierTitle: function () {
                if (this.isTargetSet()) {
                    let target = this.$store.getters.getSupplierById(this.targetSupplier.id);
                    return target.title;
                }

                return '';
            },
            selectedSupplierList: function () {
                if (!this.isTargetSet()) return [];
                let me = this;
                let suppliers = this.selectedSupplierIds.map(supplierId => me.$store.getters.getSupplierById(supplierId));
                suppliers = suppliers.filter(supplier => supplier.id !== me.targetSupplier.id);
                return suppliers.map(supplier => supplier.id + ": " + supplier.title)
            },
        },
        methods: {
            mergeSuppliers: function() {
                let me = this;
                axios.post('/api/suppliers/merge', {
                    targetSupplier: this.targetSupplier.id,
                    sourceSuppliers: this.getSourcesSupplierIds(),
                    context: this.mergeContext,
                })
                    .then(response => me.$parent.refreshTable())
                    .catch(function (error) {
                        console.log(error);
                    });
                console.log('send the merge');
            },
            fetchTargetSupplier: function() {
                if (this.targetSupplier.hasOwnProperty('id')) {
                    return this.$store.getters.getSupplierById(this.targetSupplier.id);
                }
            },
            isTargetSet: function () {
                return this.targetSupplier.hasOwnProperty('id') && !!this.targetSupplier.id;
            },
            getSourcesSupplierIds: function () {
                if (!this.isTargetSet()) return [];
                let me = this;
                let suppliers = this.selectedSupplierIds.map(supplierId => me.$store.getters.getSupplierById(supplierId));
                suppliers = suppliers.filter(supplier => supplier.id !== me.targetSupplier.id);
                return suppliers.map(supplier => supplier.id);
            },
            reset: function() {
                this.targetSupplier = {};
                this.mergeContext = ['orders', 'deactivate'];
            }
        },
        created() {
            console.log('Component mounted.')
        },
        mounted() {
            this.$store.dispatch('loadSuppliers');
        }
    }
</script>
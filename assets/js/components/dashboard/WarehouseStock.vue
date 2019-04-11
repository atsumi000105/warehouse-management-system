<template>
    <div class="table-responsive no-padding">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Category</th>
                <th class="text-right">All Stock
                    <i class="fa fa-question-circle"
                       title="This level represents all stock physically located on-site"
                       v-tooltip="'bottom'"></i></th>
                <th class="text-right">Stock (including pending orders)
                    <i class="fa fa-question-circle"
                       title="This level represents stock on-site including any pending partner orders where products are allocated but not shipped"
                       v-tooltip="'bottom'"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products">
                <td><router-link :to="'/products/' + product.id"><i class="fa fa-edit"></i>{{ product.id }}</router-link></td>
                <td v-text="product.name"></td>
                <td v-text="product.category"></td>
                <td v-text="product.balance.toLocaleString()" class="text-right"></td>
                <td v-text="product.availableBalance.toLocaleString()" class="text-right"></td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        name: "WarehouseStock",
        data() {
            return {
                products: {},
            };
        },
        methods: {
            getLevels: function() {
                axios.get('/api/stock-levels', { params: this.buildParams() }).then(response => this.products = response.data);
            },
            buildParams: function () {
                return {
                    locationType: 'WAREHOUSE'
                }
            }
        },
        created() {
            this.getLevels();
        }

    }
</script>

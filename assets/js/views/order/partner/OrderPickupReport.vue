<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Partner - Partner Name - Pickup Report
            </h3>
            <div class="col-lg-2 text-right">
                <div class="btn-group">
                    <button
                        type="button"
                        class="btn btn-info btn-flat dropdown-toggle"
                        data-toggle="dropdown"
                    >
                        <i class="fa fa-fw fa-download" />Export
                        <span class="caret" />
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul
                        class="dropdown-menu"
                        role="menu"
                    >
                        <li>
                            <a>Excel</a>
<!--                            <a @click="downloadExcel"><i class="fa fa-fw fa-file-excel" />Excel</a>-->
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <table-paged
                ref="hbtable"
                :columns="columns"
                :per-page="50"
                :params="requestParams()"
                api-url="/api/reports/pickup-report"
            ></table-paged>
        </div>
    </section>
</template>

<script>
import TablePaged from "../../../components/TablePaged";

export default {
    components: {
        TablePaged,
    },

    data() {
        return {
            columns: [
                {
                    name: 'clientId',
                    title: 'ID',
                    sortField: 'c.clientId',
                },
                {
                    name: "childFullName",
                    title: 'Child\'s Name',
                    sortField: 'c.firstName'
                },
                {
                    name: "authorizedPersons",
                    title: 'Authorized Persons',
                },
                {
                    name: "name",
                    title: 'Size Ordered',
                },
                {
                    name: "name",
                    title: 'Size Given',
                },
                {
                    name: "name",
                    title: 'Size Next Month',
                },
                {
                    name: "name",
                    title: 'Pick Up Person\'s Signature',
                },
                {
                    name: "name",
                    title: 'Date Received',
                },
                {
                    name: "expirations",
                    title: 'Expirations',
                },
                {
                    name: "name",
                    title: 'Notes',
                },
                {
                    name: "warning",
                    title: 'Warnings',
                },
            ],
            clients: [],
        };
    },

    created() {
        axios.get('/api/reports/pickup-report', {
            params: this.requestParams(),
        }).then(response => console.log(response.data.data));
    },

    methods: {
        requestParams: function() {
            return {
                orderId: this.$route.params.orderId,
                partnerId: this.$route.params.partnerId,
                include: [
                    'partner',
                    'attributes',
                    'lastDistribution',
                ],
            };
        },
    },
};
</script>

<style scoped>

</style>
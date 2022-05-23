<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Clients Demographics
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
                            <a @click.prevent="downloadExcel">
                                <i class="fa fa-fw fa-file-excel" />
                                Excel
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
                    <datefield
                        v-model="filters.monthAndYearStart"
                        label="Distribution Month & Year Start"
                        format="YYYY-MM"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                    <datefield
                        v-model="filters.monthAndYearEnd"
                        label="Distribution Month & Year End"
                        format="YYYY-MM"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                    <TextField
                        v-model="filters.zipcode"
                        label="Zip Code"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                    <TextField
                        v-model="filters.parent"
                        label="Parent"
                    />
                </div>
            </div>

            <div class="col-xs-3">
                <PartnerSelectionForm
                    v-model="filters.partner"
                    label="Assigned Partner"
                    :options="allPartners"
                    :validate="false"
                    @partner-change="setPartner"
                />
            </div>

            <div class="col-xs-1 text-right">
                <button
                    class="btn btn-success btn-flat"
                    @click="doFilter"
                >
                    <i class="fa fa-fw fa-filter" />Filter
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <table-paged
                        ref="hbtable"
                        :columns="columns"
                        :sort-order="[{ field: 'c.id', direction: 'asc' }]"
                        :params="requestParams()"
                        :per-page="50"
                        api-url="/api/reports/clients-demographics"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TablePaged from "../../components/TablePaged";
import TextField from "../../components/TextField";
import DateField from "../../components/DateField";
import {mapGetters} from "vuex";
import PartnerSelectionForm from "../../components/PartnerSelectionForm";

export default {
    name: "UniqueDemographicsReport",

    components: {
        TextField,
        TablePaged,
        datefield: DateField,
        PartnerSelectionForm,
    },

    data() {
        let columns = [
            { name: "id", title: "Client ID", sortField: "c.id" },
            { name: "parentName", title: "Parent Name" },
            { name: "client", title: "Client" },
            { name: "birthdate", title: "Birthdate" },
            { name: "clientType", title: "Client Type" },
            { name: "agencyId", title: "Agency ID" },
            { name: "agencyName", title: "Agency" },
            { name: "childRace", title: "Client Race" },
            { name: "childGender", title: "Client Gender" },
            { name: "doesChildHealthInsurance", title: "Does child have health insurance?" },
            { name: "doesParentHealthInsurance", title: "Does parent/guardian have health insurance?" },
            { name: "childMedicaid", title: "Does child have Medicaid?" },
            { name: "childHealthInsurance", title: "Child Health insurance" },
            { name: "parentHealthInsurance", title: "Parent Health insurance" },
            { name: "parentEmployed", title: "Is the parent/guardian Employed?" },
            { name: "anyOtherEmployed", title: "Are any other adults in the household employed?" },
            { name: "sourcesOfIncome", title: "Sources of Income" },
            { name: "parentCounty", title: "Parent/Guardian County" },
            { name: "zipCode", title: "Zip Code" },
            { name: "familyId", title: "Family ID" },
            { name: "childLivesWith", title: "Child lives with" },
        ];

        return {
            columns: columns,
            partners: {},
            filters: {
                monthAndYearStart: null,
                monthAndYearEnd: null,
                partner: { id: null },
                zipcode: null,
                parent: null,
            },
        };
    },

    computed: {
        ...mapGetters([
            "allPartners",
        ]),
    },

    methods: {
        requestParams: function() {
            return {
                monthAndYearStart: this.filters.monthAndYearStart || null,
                monthAndYearEnd: this.filters.monthAndYearEnd || null,
                partner: this.filters.partner.id || null,
                zipcode: this.filters.zipcode || null,
                parent: this.filters.parent || null,
            };
        },

        doFilter () {
            console.log("doFilter:", this.requestParams());
            this.$events.fire('filter-set', this.requestParams());
        },

        downloadExcel: function () {
            let params = this.requestParams();
            params.download = 'xlsx';

            axios.get('/api/reports/clients-demographics', {
                params: params,
                responseType: 'blob'
            }).then(response => {
                let fileName = response.header['content-disposition'].match(/filename="(.*)"/)[1];
                fileDownload(response.data, fileName, response.headers['content-type'])
            })
        },

        setPartner(selection) {
            this.filters.partner = selection;
        },
    },
}
</script>


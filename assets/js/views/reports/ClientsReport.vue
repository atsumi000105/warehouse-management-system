<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Clients Report
            </h3>
        </div>

        <div class="row">
            <div class="col-xs-2">
                <option-list-static
                    v-model="filters.status"
                    label="Status"
                    :preloaded-options="statuses"
                />
            </div>
            <div class="col-lg-2 col-sm-4">
                <div class="form-group">
                    <label>Type</label>
                    <select
                        v-model="filters.partnerType"
                        v-chosen
                        class="form-control"
                    >
                        <option value="">
                            --All Partner Types--
                        </option>
                        <option value="AGENCY">
                            Agency
                        </option>
                        <option value="HOSPITAL">
                            Hospital
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xs-3">
                <PartnerSelectionForm
                    v-model="filters.partner"
                    label="Assigned Partner"
                    :options="allPartners"
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
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Age Expiration</label>
                    <select
                        v-model="filters.ageExpirationOperand"
                        v-chosen
                        class="form-control"
                    >
                        <option value="">
                            --All Partner Types--
                        </option>
                        <option value="<">
                            Is less than
                        </option>
                        <option value="<=">
                            Is less than or equal to
                        </option>
                        <option value="=">
                            Is equal to
                        </option>
                        <option value="<>">
                            Is not equal to
                        </option>
                        <option value=">=">
                            Is greater than or equal to
                        </option>
                        <option value="between">
                            Is between
                        </option>
                        <option value="not between">
                            Is not between
                        </option>
                        <option value="empty">
                            Is empty (NULL)
                        </option>
                        <option value="!empty">
                            Is not empty (NOT NULL)
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <datefield
                        v-model="filters.ageExpirationValue"
                        label="Age Expiration Date"
                        format="YYYY-MM-DD"
                        timezone="Etc/UTC"
                    />
                </div>
                <div class="form-group">
                    <datefield
                        v-if="displayBasedOnOperand(filters.ageExpirationOperand)"
                        v-model="filters.ageExpirationValueTwo"
                        label="Age Expiration End Date"
                        format="YYYY-MM-DD"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Distribution Expiration</label>
                    <select
                        v-model="filters.distributionExpirationOperand"
                        v-chosen
                        class="form-control"
                    >
                        <option value="">
                            --All Partner Types--
                        </option>
                        <option value="<">
                            Is less than
                        </option>
                        <option value="<=">
                            Is less than or equal to
                        </option>
                        <option value="=">
                            Is equal to
                        </option>
                        <option value="<>">
                            Is not equal to
                        </option>
                        <option value=">=">
                            Is greater than or equal to
                        </option>
                        <option value="between">
                            Is between
                        </option>
                        <option value="not between">
                            Is not between
                        </option>
                        <option value="empty">
                            Is empty (NULL)
                        </option>
                        <option value="!empty">
                            Is not empty (NOT NULL)
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <datefield
                        v-model="filters.distributionExpirationValue"
                        label="Distribution Expiration Date"
                        format="YYYY-MM-DD"
                        timezone="Etc/UTC"
                    />
                </div>
                <div class="form-group">
                    <datefield
                        v-if="displayBasedOnOperand(filters.distributionExpirationOperand)"
                        v-model="filters.distributionExpirationValueTwo"
                        label="Distribution Expiration End Date"
                        format="YYYY-MM-DD"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <TextField
                        v-model="filters.mergedTo"
                        label="Merged To (merged_to_field)"
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
                        api-url="/api/reports/clients-report"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TablePaged from "../../components/TablePaged";
import {mapGetters} from "vuex";
import PartnerSelectionForm from "../../components/PartnerSelectionForm";
import OptionListStatic from '../../components/OptionListStatic.vue';
import DateField from "../../components/DateField.vue";
import TextField from "../../components/TextField";

export default {
    name: "ClientsReport",

    components: {
        TextField,
        datefield: DateField,
        TablePaged,
        PartnerSelectionForm,
        OptionListStatic,
    },

    data() {
        let columns = [
            { name: "clientId", title: "Client ID", sortField: "c.id" },
            { name: "id", title: "Client Public ID", sortField: "c.id" },
            { name: "clientType", title: "Client Type" },
            { name: "assignedAgency", title: "Assigned Agency" },
            { name: "adults", title: "Adults" },
            { name: "childDateOfBirth", title: "Child Date of Birth" },
            { name: "childGender", title: "Child Gender" },
            { name: "childLivesWith", title: "Child Lives with" },
            { name: "childRace", title: "Child Race" },
            { name: "childrenFiveToSeventeen", title: "Children Five to Seventeen" },
            { name: "childrenUnderFive", title: "Children Under Five" },
            { name: "childHealthInsurance", title: "Child Health Insurance" },
            { name: "parentHealthInsurance", title: "Parent Health Insurance" },
            { name: "childHaveHealthInsurance", title: "Child have Health Insurance" },
            { name: "childHaveMedicaid", title: "Child have Medicaid" },
            { name: "familyId", title: "Family ID" },
            { name: "firstDistribution", title: "First Distribution" },
            { name: "ageExpiration", title: "Age Expiration Date" },
            { name: "distributionExpiration", title: "Distribution Expires" },
            { name: "isTheChildInDaycare", title: "Is Child in Daycare" },
            { name: "nameOfDaycareProvider", title: "Name of Daycare Provider" },
            { name: "childFirstName", title: "Child First Name" },
            { name: "childLastName", title: "Child Last Name" },
            { name: "parentFirstName", title: "Parent First Name" },
            { name: "parentLastName", title: "Parent Last Name" },
            { name: "isParentEmployed", title: "Is Parent Employed" },
            { name: "parentEmploymentStatus", title: "Parent Employment Status" },
            { name: "otherAdultsInHouseholdEmployed", title: "Other Adults In Household Employed" },
            { name: "otherAdultEmploymentStatus", title: "Other Adults Employment Status" },
            { name: "monthlyTakeHomePay", title: "Monthly Take Home" },
            { name: "sourcesOfIncome", title: "Surces of Income" },
            { name: "zipCode", title: "ZIP Code" },
            { name: "county", title: "County" },
            { name: "diaperMobileRoute", title: "Diaper Mobile Route" },
            { name: "diaperEvent", title: "If you are signing up for Direct Distribution at the HappyBottoms Warehouse, how did you find out about this event?" },
            { name: "referredByHospital", title: "If you were referred by a hospital, which one?" },
            { name: "transportationMethod", title: "Transportation Method" },
            { name: "diaperSizeNeed", title: "What size diaper does this child need?" },
            { name: "pickUpLocation", title: "Where would you like to pick up diapers?" },
            { name: "emailAddress", title: "Email Address" },
            { name: "homePhone", title: "Home Phone" },
            { name: "mobilePhone", title: "Mobile Phone" },
            { name: "mergedTo", title: "Merged To" },
            { name: "mergedDate", title: "Merged Date" },
            { name: "creationDate", title: "Creation Date" },
        ];

        return {
            columns: columns,
            clients: {},
            statuses: [{ id: "ACTIVE", name: "Active" }, { id: "INACTIVE", name: "Inactive" }],
            filters: {
                keyword: null,
                partner: { id: null },
                status: null,
                partnerType: null,
                ageExpirationValue: null,
                ageExpirationValueTwo: null,
                ageExpirationOperand: null,
                distributionExpirationValue: null,
                distributionExpirationValueTwo: null,
                distributionExpirationOperand: null,
                mergedTo: null,
                zipcode: null,
            },
            operandToAllowMultipleValues: [
                'between',
                'not between',
            ],
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
                status: this.filters.status || null,
                keyword: this.filters.keyword || null,
                partner: this.filters.partner.id || null,
                partnerType: this.filters.partnerType || null,
                ageExpirationValue: this.filters.ageExpirationValue || null,
                ageExpirationValueTwo: this.filters.ageExpirationValueTwo || null,
                ageExpirationOperand: this.filters.ageExpirationOperand || null,
                distributionExpirationValue: this.filters.distributionExpirationValue || null,
                distributionExpirationValueTwo: this.filters.distributionExpirationValueTwo || null,
                distributionExpirationOperand: this.filters.distributionExpirationOperand || null,
                mergedTo: this.filters.mergedTo || null,
                zipcode: this.filters.zipcode || null,
            };
        },

        displayBasedOnOperand(operand) {
            if (this.operandToAllowMultipleValues.includes(operand)) {
                return true;
            }

            return false;
        },

        setPartner(selection) {
            this.filters.partner = selection;
        },

        downloadExcel: function () {
            let params = this.requestParams();
            params.download = 'xlsx';

            axios.get('/api/reports/clients-report', {
                params: params,
                responseType: 'blob'
            }).then(response => {
                let fileName = response.header['content-disposition'].match(/filename="(.*)"/)[1];
                fileDownload(response.data, fileName, response.headers['content-type'])
            })
        },

        doFilter () {
            console.log("doFilter:", this.requestParams());
            this.$events.fire('filter-set', this.requestParams());
        },
    },
};
</script>
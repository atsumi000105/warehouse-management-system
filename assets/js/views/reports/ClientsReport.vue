<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Clients Report
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
                            <a><i class="fa fa-fw fa-file-excel" />Excel</a>
                        </li>
                    </ul>
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
export default {
    name: "ClientsReport",

    components: {
        TablePaged,
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
            { name: "childName", title: "Child Name" },
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
            },
        };
    },

    methods: {
        requestParams: function() {
            return {
                status: this.filters.status || null,
                keyword: this.filters.keyword || null,
                partner: this.filters.partner.id || null,
                include: ["partner"]
            };
        },
    },
};
</script>
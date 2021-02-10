<template>
    <section class="content">
        <div class="pull-right">
            <button
                v-if="noDuplicates"
                class="btn btn-success btn-flat"
                @click.prevent="save"
            >
                <i class="fa fa-save fa-fw" />
                Save Client
            </button>
            <button
                v-if="!checked"
                class="btn btn-primary btn-flat"
                @click="check()"
            >
                <i class="fa fa-search fa-fw" />
                Check for Duplicate
            </button>
        </div>

        <h3 class="box-title">
            New Client
        </h3>

        <section
            v-if="!checked"
            id="new-client-check"
        >
            <div class="row">
                <form role="form">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="icon fa fa-child fa-fw" />Client Info
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="client_info" class="row active">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input
                                                v-model="client.firstName"
                                                type="text"
                                                class="form-control"
                                                placeholder="Enter first name"
                                            >

                                            <label>Last Name</label>
                                            <input
                                                v-model="client.lastName"
                                                type="text"
                                                class="form-control"
                                                placeholder="Enter last name"
                                            >
                                        </div>
                                        <DateField
                                            v-model="client.birthdate"
                                            label="Birthdate"
                                            format="YYYY-MM-DD"
                                        />
                                    </div>
                                </div>
                                <AttributesEditForm
                                    id="profile_tab"
                                    v-model="client.attributes"
                                    :filter="(attribute) => attribute.isDuplicateReference"
                                />
                                <!-- text input -->

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </section>

        <section
            v-if="foundDuplicates"
            id="duplicates"
        >
            <div class="alert alert-danger">
                <h3 class="alert-heading">Duplicate Clients Found</h3>
                Based on the information provided, this client appears to be a duplicate of the following client(s). If inactive, please transfer a client below to your partner agency.
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-hover">
                                <thead>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Partner</th>
                                    <th>Last Activity</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr v-for="duplicate in duplicates">
                                        <td v-text="duplicate.fullName"></td>
                                        <td v-text="duplicate.status"></td>
                                        <td v-text="duplicate.partner.title"></td>
                                        <td v-text="duplicate.lastDistribution.order.distributionPeriod"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section
            v-if="noDuplicates"
            id="new-client">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <ClientInfoForm
                                v-model="client"
                                :show-expirations="false"
                            />
                            <AttributesEditForm
                                v-model="client.attributes"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>


</template>

<script>
import AttributesEditForm from "../../components/AttributesEditForm";
import PartnerSelectionForm from "../../components/PartnerSelectionForm";
import DateField from "../../components/DateField";
import BooleanField from "../../components/ToggleField";
import NumberField from "../../components/NumberField";
import DisplayField from "../../components/DisplayField";
import TableStatic from "../../components/TableStatic";
import ClientInfoForm from "./ClientInfoForm";

export default {
    name: 'ClientNewCheck',
    components: {
        ClientInfoForm,
        DateField,
        AttributesEditForm,
    },
    data() {
        return {
            client: {
                attributes: [],
                partner: {},
            },
            duplicates: [],
            checked: false
        };
    },
    computed: {
        foundDuplicates: function() { return this.checked && this.duplicates.length > 0 },
        noDuplicates: function() { return this.checked && this.duplicates.length === 0 }
    },
    created() {
        let self = this;
        axios
            .get('/api/clients/fields', {
                params: { include: ['options']}
            })
            .then(response => this.client.attributes = response.data.data)
            .catch(function (error) {
                console.log("Save this.client error %o", error);
            });
        console.log('ClientEdit Component mounted.');
    },
    methods: {
        check: function () {
            let self = this;
            axios
                .post('/api/clients/new-check', this.client, {
                    params: { include: ['partner', 'lastDistribution', 'lastDistribution.order']}
                })
                .then(response => {
                    self.duplicates = response.data.data;
                    self.checked = true;
                })
                .catch(function (error) {
                    console.log("Save this.client error %o", error);
                });
        },
        save: function () {
            let self = this;
            axios
                .post('/api/clients', this.client)
                .then(response => self.$router.push({ name: 'clients' }))
                .catch(function (error) {
                    console.log("Save this.client error %o", error);
                });
        },
    }
}
</script>

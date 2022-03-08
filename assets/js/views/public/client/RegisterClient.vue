<template>
    <div>
        <div class="jumbotron">
            <h3>Client Registration</h3>
            <p>Please complete this form for each child who needs diapers.</p>
        </div>
        <div class="row">
            <div class="container">
                <div class="panel">
                    <div class="panel-heading">
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
                    </div>
                    <div class="panel-body">
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
                                                <div
                                                    id="client_info"
                                                    class="row active"
                                                >
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <div :class="{ 'has-error': $v.client.firstName.$error }">
                                                                <input
                                                                    v-model="client.firstName"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Enter first name"
                                                                >
                                                                <fielderror v-if="$v.client.firstName.$error">
                                                                    First Name is required
                                                                </fielderror>
                                                            </div>
                                                            <label>Last Name</label>
                                                            <div :class="{ 'has-error': $v.client.lastName.$error }">
                                                                <input
                                                                    v-model="client.lastName"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Enter last name"
                                                                >
                                                                <fielderror v-if="$v.client.lastName.$error">
                                                                    Last Name is required
                                                                </fielderror>
                                                            </div>
                                                        </div>
                                                        <div :class="{ 'has-error': $v.client.birthdate.$error }">
                                                            <DateField
                                                                v-model="client.birthdate"
                                                                label="Birthdate"
                                                                format="YYYY-MM-DD"
                                                            />
                                                            <fielderror v-if="$v.client.birthdate.$error">
                                                                Birthdate should be a date in the past
                                                            </fielderror>
                                                        </div>
                                                    </div>
                                                </div>
                                                <AttributesEditForm
                                                    id="profile_tab"
                                                    v-model="client.attributes"
                                                    :value="[]"
                                                    :filter="attribute => attribute.isDuplicateReference"
                                                />
                                                <!-- text input -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12" />
                            </div>
                        </section>

                        <section
                            v-if="foundDuplicates"
                            id="duplicates"
                        >
                            <div class="callout callout-info">
                                <h3>Duplicate Record Found</h3>
                                Based on the information provided, this client appears to be a duplicate of the following client(s). If
                                inactive, please transfer a client below to your partner agency.
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <table class="table table-hover">
                                                <thead>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Last Activity</th>
                                                <th>Partner</th>
                                                </thead>
                                                <tbody>
                                                <tr
                                                    v-for="duplicate in duplicates"
                                                    :key="duplicate.id"
                                                >
                                                    <td v-text="duplicate.fullName" />
                                                    <td v-text="duplicate.status" />
                                                    <td>
                                            <span
                                                v-if="duplicate.lastDistribution"
                                                v-text="duplicate.lastDistribution.order.distributionPeriod"
                                            />
                                                    </td>
                                                    <td v-text="duplicate.partner ? duplicate.partner.title : ''" />
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
                            id="new-client"
                        >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <ClientInfoForm
                                                ref="clientInfoForm"
                                                v-model="client"
                                                :show-expirations="false"
                                                :new="false"
                                            />
<!--                                            <AttributesEditForm v-model="client.attributes" />-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import {mustLessThanNow} from "../../../validators";
import DateField from "../../../components/DateField";
import {mapGetters} from "vuex";
import ClientTransferModal from "../../client/ClientTransferModal";
import ClientInfoForm from "../../client/ClientInfoForm";
import AttributesEditForm from "../../../components/AttributesEditForm";
import FieldError from "../../../components/FieldError";
import ModalOrderInvalid from "../../../components/ModalOrderInvalid";

export default {
    components: {
        ClientInfoForm,
        DateField,
        AttributesEditForm,
        fielderror: FieldError,
    },

    data() {
        return {
            client: {
                attributes: [],
                partner: {},
            },
            duplicates: [],
            checked: false,
            transferClient: {},
        };
    },

    validations: {
        client: {
            firstName: {
                required
            },
            lastName: {
                required
            },
            birthdate: {
                required,
                mustLessThanNow
            }
        }
    },

    computed: {
        ...mapGetters(["userActivePartner", "isPartner"]),
        foundDuplicates: function() {
            return this.checked && this.duplicates.length > 0;
        },
        noDuplicates: function() {
            return this.checked && this.duplicates.length === 0;
        }
    },

    watch: {
        'userActivePartner': {
            handler(activePartner) {
                if (this.isPartner) {
                    this.client.partner = activePartner
                }
            },
            deep: true
        }
    },

    created() {
        let self = this;

        axios
            .get("/api/clients/fields", {
                params: { include: ["options"] }
            })
            .then(response => (this.client.attributes = response.data.data))
            .catch(function(error) {
                console.log("Save this.client error %o", error);
            });

        console.log("ClientEdit Component mounted.");
    },

    methods: {
        check: function() {
            let self = this;
            this.$v.$touch();

            if (this.$v.$invalid) {
                $("#invalidModal").modal("show");
                return false;
            }

            console.log(this.client);

            axios
                .post("/api/clients/new-check", this.client, {
                    params: { include: ["partner", "lastDistribution", "lastDistribution.order"] }
                })
                .then(response => {
                    self.duplicates = response.data.data;
                    self.checked = true;
                })
                .catch(function(error) {
                    console.log("Save this.client error %o", error);
                });
        },

        save: function() {
            let self = this;

            if (this.$refs.clientInfoForm) {
                this.$refs.clientInfoForm.$v.$touch();
                if (this.$refs.clientInfoForm.$v.$invalid) {
                    $("#invalidModal").modal("show");
                    return false;
                }
            }

            axios
                .post("/api/public/client", this.client)
                .then(response => self.$router.push({ name: "clients" }))
                .catch(function(error) {
                    console.log("Save this.client error %o", error);
                });
        },

        onTransferClicked: function(client) {
            this.transferClient = client;
            $("#clientTransferModal").modal("show");
        },

        transferButtonTooltip: function(rowData) {
            if (rowData.canPartnerTransfer) {
                return "Transfer client to " + this.userActivePartner.title;
            }
            return "This client is not in a transferable status or you do not have access.";
        }
    }
};
</script>

<style scoped>

</style>
<template>
    <div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>New To Us?</h3>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <h4>Did you sign up for our services while you were in the hospital?</h4>
                    <div class="form-check">
                        <input type="radio" id="hospital_yes" value="1" v-model="hospital">
                        <label for="hospital_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="hospital_no" value="0" v-model="hospital">
                        <label for="hospital_no">No</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="hospital==0" class="panel panel-default">
            <div class="panel-heading">
                <h3>Duplicate Check</h3>
            </div>
            <div class="row">
                <div v-if="!checked" class="col-md-6 col-md-offset-1">
                    <h4>Please enter your child's First Name, Last Name, and Birth Date to see if we already have a record for you.</h4>
                    <form>
                        <div class="form-row">
                            <div
                                class="form-group"
                                :class="{ 'has-error': $v.client.firstName.$error }"
                            >
                                <label for="dup_first_name">First Name</label>
                                <input
                                    v-model="client.firstName"
                                    id="dup_first_name"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter first name"
                                >
                                <fielderror v-if="$v.client.firstName.$error">
                                    First Name is required
                                </fielderror>
                            </div>
                        </div>
                        <div class="form-row">
                            <div
                                class="form-group"
                                :class="{ 'has-error': $v.client.lastName.$error }"
                            >
                                <label for="dup_last_name">Last Name</label>
                                <input
                                    v-model="client.lastName"
                                    id="dup_last_name"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter last name"
                                >
                                <fielderror v-if="$v.client.lastName.$error">
                                    Last Name is required
                                </fielderror>
                            </div>
                        </div>
                        <div class="form-row">
                            <div
                                class="form-group"
                                :class="{ 'has-error': $v.client.birthdate.$error }"
                            >
                                <DateField
                                    id="dup_birth_date"
                                    v-model="client.birthdate"
                                    label="Birth Date"
                                    format="YYYY-MM-DD"
                                />
                                <fielderror v-if="$v.client.birthdate.$error">
                                    Birth Date should be a date in the past
                                </fielderror>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <button
                                    class="btn btn-primary btn-flat"
                                    @click="check()"
                                >
                                    <i class="fa fa-search fa-fw" />
                                    Check for Duplicate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div v-if="checked && foundDuplicates">
                        <div class="callout callout-warning no-background-color text-black">
                            <h3>Duplicate Record Found</h3>
                            Based on the information provided, it appears you may already be a client.  Our records
                            show you may be associated with the following Partner, please contact them for more assistance.
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Partner</th>
                                        <th>Partner Address</th>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="duplicate in duplicates"
                                            :key="duplicate.id"
                                        >
                                            <td v-text="duplicate.partner ? duplicate.partner.title : ''" />
                                            <td v-text="duplicate.partner ? duplicate.partner.fullAddress : ''" />
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div v-if="checked && !foundDuplicates">
                        <div class="callout callout-success no-background-color text-black">
                            <h3>No Duplicates Found</h3>
                            Based on the information provided, it appears you are not already a client.  Please fill
                            out the form below to register.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="hospital==0 && checked && !foundDuplicates" class="panel panel-default">
            <div class="panel-heading">
                <h3>New Client Info</h3>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <ClientInfoForm
                        ref="clientInfoForm"
                        v-model="client"
                        :show-expirations="false"
                        :new="false"
                    />
                    <AttributesEditForm
                        ref="attributesEditForm"
                        v-model="client.attributes"
                        :only-public-attributes="true"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <button
                        v-if="noDuplicates"
                        class="btn btn-success btn-flat pull-right"
                        @click.prevent="save"
                    >
                        <i class="fa fa-save fa-fw" />
                        Save Client
                    </button>
                </div>
            </div>
        </div>
        <modalinvalid />
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import {mustLessThanNow} from "../../../validators";
import DateField from "../../../components/DateField";
import {mapGetters} from "vuex";
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
        modalinvalid: ModalOrderInvalid
    },

    data() {
        return {
            client: {
                attributes: [],
                partner: {},
            },
            hospital: 1,
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

        checkChildren: function(children) {
            let hasError = false;
            const self = this;

            children.forEach(child => {

                if (child.$children) {
                    self.checkChildren(child.$children);
                }

                if (child.$v) {
                    child.$v.touch();
                    if (child.$v.$error) {
                        hasError = true;
                    }
                }
            });

            return hasError;
        },

        save: function() {
            let self = this;

            let clientInfoFormHasError = false;
            let attributesEditFormHasError = false;

            if (this.$refs.clientInfoForm) {

                if (this.$refs.clientInfoForm.$children) {
                    this.$refs.clientInfoForm.$children.forEach(child => {
                        if (child.$children) {
                            child.$children.forEach(grandChild => {

                                if (grandChild.$children) {
                                    grandChild.$children.forEach(x => {
                                        if (x.$v) {
                                            x.$v.$touch();

                                            if (x.$v.$error) {
                                                clientInfoFormHasError = true;
                                            }
                                        }
                                    });
                                }

                                if (grandChild.$v) {
                                    grandChild.$v.$touch();

                                    if (grandChild.$v.$error) {
                                        clientInfoFormHasError = true;
                                    }
                                }
                            });
                        }

                        if (child.$v) {
                            child.$v.$touch();

                            if (child.$v.$error) {
                                clientInfoFormHasError = true;
                            }
                        }

                    });
                }

                this.$refs.clientInfoForm.$v.$touch();
                if (this.$refs.clientInfoForm.$v.$error) {
                    clientInfoFormHasError = true;
                }
            }

            if (this.$refs.attributesEditForm && this.$refs.attributesEditForm.$children) {

                this.$refs.attributesEditForm.$children.forEach(child => {

                    if (child.$children) {

                        child.$children.forEach(grandChild => {

                            if (grandChild.$v) {
                                grandChild.$v.$touch();

                                if (grandChild.$v.$error) {
                                    attributesEditFormHasError = true;
                                }
                            }
                        });
                    }

                    if (child.$v) {
                        child.$v.$touch();

                        if (child.$v.$error) {
                            attributesEditFormHasError = true;
                        }
                    }
                });
            }

            console.log('clientInfoFormHasError', clientInfoFormHasError);
            console.log('attributesEditFormHasError', attributesEditFormHasError);
            console.log('clientInfoFormHasError || attributesEditFormHasError', clientInfoFormHasError || attributesEditFormHasError);

            console.log('this.client: ', this.client);

            if (clientInfoFormHasError || attributesEditFormHasError) {
                $("#invalidModal").modal("show");
                return false;
            }

            axios
                .post("/api/public/client", this.client)
                .then(response => self.$router.push({ name: "clients" }))
                .catch(function(error) {
                    console.log("Save this.client error %o", error);
                });
        },
    }
};
</script>

<style scoped>
    .no-background-color {
        background-color: transparent !important;
    }

    .text-black {
        color: black !important;
    }
</style>
<template>
    <div>

        <div v-if="!savedAndFinished" class="panel panel-default">
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

        <div v-if="hospital == 1" class="panel panel-default">
            <div class="panel-heading">
                <h3>Hospital Signup Information</h3>
            </div>
            <div class="panel-body">
                <p>
                    There is no need to register, you have already received HappyBottoms diapers! For monthly diapers,
                    just find an agency that works for you and go during their distribution days/times.
                    Visit <a href="https://appyBottoms.org/get-diapers" target="_blank">HappyBottoms.org/get-diapers</a>
                    for agency information.
                </p>
            </div>
        </div>

        <div v-if="hospital ==0 && !savedAndFinished" class="panel panel-default">
            <div class="panel-heading">
                <h3>Duplicate Check</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div v-if="!checked || (checked && foundDuplicates)" class="col-md-6 col-md-offset-1">
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
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-12">
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
                            </div>
                        </div>
                        <div v-if="checked && !foundDuplicates" class="callout callout-success no-background-color text-black">
                            <h3>No Duplicates Found</h3>
                            Based on the information provided, it appears you are not already a client.  Please fill
                            out the form below to register.
                        </div>
                    </div>
                </div>
                <div v-if="checked && foundDuplicates" class="row">
                    <div class="container-fluid">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                FAQ
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li>
                                        <strong>When can I pick up diapers?: </strong>
                                        You can pick up diapers once a month during your agency’s pickup time
                                        (see above). Even if you have not picked up for several months,
                                        you do not need to create another application. Please contact your agency.
                                    </li>
                                    <li>
                                        <strong>Can I go to a different agency?: </strong>
                                        Yes, please contact the agency you are assigned to and ask them to
                                        make you “inactive” in our system. Then you can go to the new agency
                                        during their distribution days/times.
                                    </li>
                                    <li>
                                        <strong>Have other questions?: </strong>
                                        Please visit our website at <a href="https://HappyBottoms.org/Get-Diapers">HappyBottoms.org/Get-Diapers</a>
                                        or email us at GetDiapers@HappyBottoms.org.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="hospital == 0 && checked && !foundDuplicates && !savedAndFinished" class="panel panel-default">
            <div class="panel-heading">
                <h3>New Client Info</h3>
            </div>
            <div class="panel-body">
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
                <div class="row">
                    <div class="container-fluid">
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
            </div>
        </div>

        <div v-if="savedAndFinished">
            <div class="row align-items-center justify-content-center no-gutters" style="margin-top: 20px;">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="alert alert-success shadow my-3" role="alert" style="border-radius: 3px">
                        <div class="text-center">
                            <svg width="3em" height="3em" viewBox="0 0 16 16" class="m-1 bi bi-shield-fill-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 .5c-.662 0-1.77.249-2.813.525a61.11 61.11 0 0 0-2.772.815 1.454 1.454 0 0 0-1.003 1.184c-.573 4.197.756 7.307 2.368 9.365a11.192 11.192 0 0 0 2.417 2.3c.371.256.715.451 1.007.586.27.124.558.225.796.225s.527-.101.796-.225c.292-.135.636-.33 1.007-.586a11.191 11.191 0 0 0 2.418-2.3c1.611-2.058 2.94-5.168 2.367-9.365a1.454 1.454 0 0 0-1.003-1.184 61.09 61.09 0 0 0-2.772-.815C9.77.749 8.663.5 8 .5zm2.854 6.354a.5.5 0 0 0-.708-.708L7.5 8.793 6.354 7.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                            </svg>
                        </div>
                        <p style="font-size:18px" class="text-center mb-0 font-weight-light">
                            Thanks for submitting an application!
                        </p>
                    </div>
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
            savedAndFinished: false,
            hospital: null,
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

            console.log('this.client: ', this.client);

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

            if (clientInfoFormHasError || attributesEditFormHasError) {
                $("#invalidModal").modal("show");
                return false;
            }

            axios
                .post("/api/public/client", this.client)
                .then((response) => {
                    console.log(response);
                    this.savedAndFinished = true;
                })
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
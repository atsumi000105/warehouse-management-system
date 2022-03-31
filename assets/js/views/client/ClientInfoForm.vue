<template>
    <div
        id="client_info"
        class="row tab-pane active"
    >

        <div class="form-group">
            <div class="col-md-6">
                <label>
                    First Name
                    <i class="fas fa-asterisk fa-fw text-danger"/>
                </label>
                <div :class="{ 'has-error': $v.value.firstName.$error }">
                    <input
                        v-model="value.firstName"
                        type="text"
                        class="form-control"
                        placeholder="Enter first name"
                    >
                    <FieldError v-if="$v.value.firstName.$error">
                        First Name is required
                    </FieldError>
                </div>
            </div>

            <div class="col-md-6">
                <label>
                    Last Name
                    <i class="fas fa-asterisk fa-fw text-danger"/>
                </label>
                <div :class="{ 'has-error': $v.value.lastName.$error }">
                    <input
                        v-model="value.lastName"
                        type="text"
                        class="form-control"
                        placeholder="Enter last name"
                    >
                    <FieldError v-if="$v.value.lastName.$error">
                        Last Name is required
                    </FieldError>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <label>
                    Parent/Guardian First Name
                    <i class="fas fa-asterisk fa-fw text-danger"/>
                </label>
                <div :class="{ 'has-error': $v.value.parentFirstName.$error }">
                    <input
                        v-model="value.parentFirstName"
                        type="text"
                        class="form-control"
                        placeholder="Enter parent or guardian first name"
                    >
                    <FieldError v-if="$v.value.parentFirstName.$error">
                        Last Name is required
                    </FieldError>
                </div>
            </div>

            <div class="col-md-6">
                <label>
                    Parent/Guardian Last Name
                    <i class="fas fa-asterisk fa-fw text-danger"/>
                </label>
                <div :class="{ 'has-error': $v.value.parentLastName.$error }">
                    <input
                        v-model="value.parentLastName"
                        type="text"
                        class="form-control"
                        placeholder="Enter parent or guardian last name"
                    >
                    <FieldError v-if="$v.value.parentLastName.$error">
                        Last Name is required
                    </FieldError>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div :class="{ 'has-error': $v.value.birthdate.$error }">
                <DateField
                    v-model="value.birthdate"
                    label="Birthdate"
                    format="YYYY-MM-DD"
                />
                <FieldError v-if="$v.value.birthdate.$error">
                    Birthdate should be a date in the past
                </FieldError>
            </div>
        </div>

        <div class="col-md-6">
            <div :class="{ 'has-error': $v.partner.id.$error }">
                <PartnerSelectionForm
                    v-model="partner"
                    label="Assigned Partner"
                    :options="allPartners"
                    :editable="!this.new"
                    :is-required="true"
                    :validate="false"
                    @partner-change="updatePartner"
                />
                <FieldError v-if="$v.partner.id.$error">
                    Partner is required
                </FieldError>
            </div>
        </div>

        <div class="col-md-6">
            <div
                v-if="showExpirations"
                class="box box-info"
            >
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon far fa-clock fa-fw" />Expiration Info
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <BooleanField
                        v-model="value.isExpirationOverridden"
                        label="Override Expirations"
                        :disabled="readOnlyExpiration"
                    />
                    <DateField
                        v-model="value.ageExpiresAt"
                        label="Age Expiration"
                        format="YYYY-MM-DD"
                        :disabled="readOnlyExpiration"
                    />
                    <DateField
                        v-model="value.distributionExpiresAt"
                        label="Distribution Expiration"
                        format="YYYY-MM-DD"
                        :disabled="readOnlyExpiration"
                    />
                    <NumberField
                        v-model="value.pullupDistributionMax"
                        label="Pullup Maximum Limit"
                        :disabled="readOnlyExpiration"
                    />
                    <DisplayField
                        v-model="value.pullupDistributionCount"
                        label="Pullup Distributions"
                    />
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</template>

<script>
import PartnerSelectionForm from "../../components/PartnerSelectionForm";
import DateField from "../../components/DateField";
import BooleanField from "../../components/ToggleField";
import NumberField from "../../components/NumberField";
import DisplayField from "../../components/DisplayField";
import ClientDistributionHistory from "./ClientDistributionHistory";
import { required } from "vuelidate/lib/validators";
import { mustLessThanNow } from "../../validators";
import { mapGetters } from "vuex";
import FieldError from "../../components/FieldError";
import axios from "axios";

export default {
    name: "ClientInfoForm",

    components: {
        DisplayField,
        NumberField,
        BooleanField,
        DateField,
        PartnerSelectionForm,
        FieldError,
    },

    props: {
        new: {
            type: Boolean,
            default: false,
            required: false,
        },
        showExpirations: {
            type: Boolean,
            default: true,
            required: false,
        },
        value: {
            required: true,
            type: [
                Object,
                Array,
            ],
        },
        readOnlyExpiration: {
            type: Boolean,
            default: false,
        }
    },

    data() {
        return {
            partner: {
                id: null,
            }
        }
    },

    validations: {
        value: {
            firstName: {
                required,
            },
            lastName: {
                required,
            },
            parentFirstName: {
                required,
            },
            parentLastName: {
                required,
            },
            birthdate: {
                required,
                mustLessThanNow
            },
        },
        partner: {
            id: {
                required,
            },
        },
    },

    computed: mapGetters(["allPartners"]),

    watch: {
        value(val) {
            if (val) {
                this.partner = val.partner;
            }
        },
    },

    created() {
        let self = this;

        this.partner = _.cloneDeep(this.value.partner);

        console.log("ClientEdit Component mounted.");
    },

    methods: {
        updatePartner: function (partner) {
            if (partner !== null && partner.id) {
                this.value.partner.id = partner.id;
            }
        },

        getFieldClass: function (v) {
            if (v.value.partner.$error) {
                return 'form-group has-error';
            }

            return 'form-group';
        },
    },
};
</script>

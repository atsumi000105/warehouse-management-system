<template>
    <section class="content">
        <div class="pull-right">
            <button
                class="btn btn-success btn-flat"
                @click.prevent="save"
            >
                <i class="fa fa-save fa-fw" />Save Partner
            </button>
            <div class="btn-group">
                <button
                    type="button"
                    class="btn btn-default dropdown-toggle dropdown btn-flat"
                    data-toggle="dropdown"
                >
                    <span class="fa fa-ellipsis-v" />
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a
                            href="#"
                            @click.prevent="askDelete"
                        >
                            <i class="fa fa-trash fa-fw" />Delete Partner
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">
            Edit Partner
        </h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="icon fa fa-industry fa-fw" />Partner Info
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Partner Name</label>
                                <input
                                    v-model="partner.title"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter partner name"
                                >
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select
                                    v-model="partner.partnerType"
                                    class="form-control"
                                >
                                    <option value="AGENCY">
                                        Agency
                                    </option>
                                    <option value="HOSPITAL">
                                        Hospital
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <optionlist
                                    v-model="partner.fulfillmentPeriod"
                                    label="Fulfillment Period"
                                    api-path="partners/fulfillment-periods"
                                />
                            </div>
                            <div class="form-group">
                                <optionlist
                                    v-model="partner.distributionMethod"
                                    label="Distribution Method"
                                    api-path="partners/distribution-methods"
                                />
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select
                                    v-model="partner.status"
                                    class="form-control"
                                >
                                    <option value="ACTIVE">
                                        Active
                                    </option>
                                    <option value="INACTIVE">
                                        Inactive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Number of previous months to average for forecasting</label>
                                <input
                                    v-model="partner.forecastAverageMonths"
                                    type="text"
                                    class="form-control"
                                    placeholder="3 (default)"
                                >
                            </div>
                            <div class="form-group">
                                <label>Legacy ID (Portal)</label>
                                <input
                                    v-model="partner.legacyId"
                                    type="text"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="icon fa fa-map-marker fa-fw" />Location
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <addressform :address="partner.address" />
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div class="col-md-6">
                    <template>
                        <div
                            v-for="contact in partner.contacts"
                            :key="contact.id"
                        >
                            <div
                                v-if="!contact.isDeleted"
                                class="box box-info"
                            >
                                <div class="box-header with-border">
                                    <button
                                        class="btn btn-xs btn-danger btn-flat pull-right"
                                        title="Remove Contact"
                                        @click.prevent="contact.isDeleted = true"
                                    >
                                        <i class="fa fa-trash fa-fw" />
                                    </button>
                                    <h3 class="box-title">
                                        <i class="icon fa fa-user fa-fw" />{{ contact.firstName }} {{ contact.lastName }}
                                    </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <contact :contact="contact" />
                                </div>
                            <!-- /.box-body -->
                            </div>
                            <div
                                v-else=""
                                class="box box-danger bg-gray"
                            >
                                <div class="box-header">
                                    <button
                                        class="btn btn-xs btn-info btn-flat pull-right"
                                        title="Undo Delete"
                                        @click.prevent="contact.isDeleted = false"
                                    >
                                        <i class="fa fa-undo fa-fw" />
                                    </button>
                                    <h3 class="box-title">
                                        <i class="icon fa fa-trash fa-fw" />Marked for deletion: {{ contact.firstName }} {{ contact.lastName }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </template>
                    <button
                        class="btn btn-info btn-flat pull-right"
                        @click.prevent="partner.contacts.push({isDeleted: false})"
                    >
                        <i class="fa fa-plus fa-fw" />New contact
                    </button>
                </div>
            </form>
        </div>
        <modal
            id="confirmModal"
            :confirm-action="this.deletePartner"
            classes="modal-danger"
        >
            <template slot="header">
                Delete Partner
            </template>
            <p>Are you sure you want to delete <strong>{{ partner.title }}</strong>?</p>
            <template slot="confirmButton">
                Delete Partner
            </template>
        </modal>
    </section>
</template>


<script>
    import Modal from '../../components/Modal.vue';
    import AddressForm from '../../components/AddressFormFields.vue';
    import ContactFormFields from '../../components/ContactFormFields.vue';
    import OptionList from '../../components/OptionList.vue';

    export default {
        components: {
            'modal' : Modal,
            'addressform' : AddressForm,
            'contact' : ContactFormFields,
            'optionlist' : OptionList
        },
        props: ['new'],
        data() {
            return {
                partner: {
                    address: {},
                    contacts: [],
                    fulfillmentPeriod: {},
                    distributionMethod: { },
                }
            };
        },
        created() {
            var self = this;
            if (this.new) {
                this.partner.contacts.push({ isDeleted: false });
            } else {
                axios
                    .get('/api/partners/' + this.$route.params.id)
                    .then(response => self.partner = response.data.data);
            }
            console.log('Component mounted.')
        },
        methods: {
            save: function () {
                var self = this;
                if (this.new) {
                    axios
                        .post('/api/partners', this.partner)
                        .then(response => self.$router.push('/partners'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .patch('/api/partners/' + this.$route.params.id, this.partner)
                        .then(response => self.$router.push('/partners'))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deletePartner: function() {
                var self = this;
                axios
                    .delete('/api/partners/' + this.$route.params.id)
                    .then(self.$router.push('/partners'));
            }
        }
    }
</script>

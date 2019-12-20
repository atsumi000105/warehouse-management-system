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

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a
                        href="#location_tab"
                        data-toggle="tab"
                        aria-expanded="true"
                    >Location and Contacts</a>
                </li>
                <li>
                    <a
                        href="#profile_tab"
                        data-toggle="tab"
                    >Profile</a>
                </li>
            </ul>
            <div class="tab-content">
                <PartnerLocationEditTab
                    id="location_tab"
                    v-model="partner"
                    class="tab-pane active"
                ></PartnerLocationEditTab>
                <PartnerProfileEditTab
                    id="profile_tab"
                    v-model="partner"
                    class="tab-pane"
                ></PartnerProfileEditTab>
            </div>
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

    import PartnerLocationEditTab from './PartnerLocationEditTab';
    import PartnerProfileEditTab from './PartnerProfileEditTab';

    export default {
        components: {
            PartnerLocationEditTab,
            PartnerProfileEditTab,
            'modal' : Modal
        },
        props: {
            new: {
                type: String,
                default: '',
                required: false
            },
            hasTitle: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                partner: {
                    address: {},
                    contacts: [],
                    fulfillmentPeriod: {},
                    distributionMethod: { },
                    profile: {},
                }
            };
        },
        created() {
            var self = this;
            if (this.new) {
                this.partner.contacts.push({ isDeleted: false });
            } else {
                axios
                    .get('/api/partners/' + this.$route.params.id, {
                        params: { include: ['profile.attributes.options']}
                    }).then(response => self.partner = response.data.data);
            }
            console.log('Component mounted.')
        },
        methods: {
            save: function () {
                let self = this;
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
                let self = this;
                axios
                    .delete('/api/partners/' + this.$route.params.id)
                    .then(self.$router.push('/partners'));
            }
        }
    }
</script>

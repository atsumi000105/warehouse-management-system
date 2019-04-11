<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save Partner</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Partner</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Partner</h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-industry fa-fw"></i>Partner Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Partner Name</label>
                                <input type="text" class="form-control" placeholder="Enter partner name" v-model="partner.title">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" v-model="partner.partnerType">
                                    <option value="AGENCY">Agency</option>
                                    <option value="HOSPITAL">Hospital</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <hb-optionlist
                                        v-model="partner.fulfillmentPeriod"
                                        label="Fulfillment Period"
                                        apiPath="partners/fulfillment-periods"></hb-optionlist>
                            </div>
                            <div class="form-group">
                                <hb-optionlist
                                        v-model="partner.distributionMethod"
                                        label="Distribution Method"
                                        apiPath="partners/distribution-methods"></hb-optionlist>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" v-model="partner.status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Number of previous months to average for forecasting</label>
                                <input type="text" class="form-control" placeholder="3 (default)" v-model="partner.forecastAverageMonths">
                            </div>
                            <div class="form-group">
                                <label>Legacy ID (Portal)</label>
                                <input type="text" class="form-control" v-model="partner.legacyId">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-map-marker fa-fw"></i>Location</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <hb-addressform :address="partner.address"></hb-addressform>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>


                <div class="col-md-6">
                    <template v-for="(contact, key) in partner.contacts">
                        <div v-if="!contact.isDeleted" class="box box-info">
                            <div class="box-header with-border">
                                <button class="btn btn-xs btn-danger btn-flat pull-right" v-on:click.prevent="contact.isDeleted = true" title="Remove Contact"><i class="fa fa-trash fa-fw"></i></button>
                                <h3 class="box-title"><i class="icon fa fa-user fa-fw"></i>{{ contact.firstName }} {{ contact.lastName }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <hb-contact :contact="contact"></hb-contact>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div v-else="" class="box box-danger bg-gray">
                            <div class="box-header">
                                <button class="btn btn-xs btn-info btn-flat pull-right" v-on:click.prevent="contact.isDeleted = false" title="Undo Delete"><i class="fa fa-undo fa-fw"></i></button>
                                <h3 class="box-title"><i class="icon fa fa-trash fa-fw"></i>Marked for deletion: {{ contact.firstName }} {{ contact.lastName }}</h3>
                            </div>
                        </div>
                    </template>
                    <button class="btn btn-info btn-flat pull-right" v-on:click.prevent="partner.contacts.push({isDeleted: false})"><i class="fa fa-plus fa-fw"></i>New contact</button>
                </div>

            </form>
        </div>
        <hb-modal :confirmAction="this.deletePartner" classes="modal-danger" id="confirmModal">
            <template slot="header">Delete Partner</template>
            <p>Are you sure you want to delete <strong>{{partner.title}}</strong>?</p>
            <template slot="confirmButton">Delete Partner</template>
        </hb-modal>
    </section>
</template>


<script>
    export default {
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
        methods: {
            save: function () {
                var self = this;
                if(this.new) {
                    axios.post('/api/partners', this.partner)
                        .then(response => self.$router.push('/partners'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/partners/' + this.$route.params.id, this.partner)
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
                axios.delete('/api/partners/' + this.$route.params.id).then(self.$router.push('/partners'));
            }
        },
        created() {
            var self = this;
            if(this.new) {
                this.partner.contacts.push({ isDeleted: false });
            } else {
                axios.get('/api/partners/' + this.$route.params.id).then(response => self.partner = response.data.data);
            }
            console.log('Component mounted.')
        }
    }
</script>
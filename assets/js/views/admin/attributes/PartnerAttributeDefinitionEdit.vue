<template>
    <section class="content">
        <div class="pull-right">
            <button
                class="btn btn-success btn-flat"
                @click.prevent="save"
            >
                <i class="fa fa-save fa-fw" />
                Save Attribute
            </button>
        </div>
        <h3 class="box-title">
            Edit Partner Attribute Definition
        </h3>

        <div class="row">
            <form role="form">
                <div class="col-md-12">
                    <div class="box box-info">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Attribute Label</label>
                                <input
                                    v-model="definition.label"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter attribute name"
                                >
                            </div>
                            <OptionList
                                v-model="definition"
                                label="Attribute Type"
                                api-path="system/attribute-types"
                                display-property="label"
                                property="type"
                            ></OptionList>
                            <div class="form-group">
                                <label>Attribute Machine Name</label>
                                <input
                                    v-model="definition.name"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter attribute name"
                                >
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>


<script>
    import OptionList from "../../../components/OptionList";

    export default {
        props: ['new'],
        components: {
            OptionList
        },
        data() {
            return {
                definition: {
                },
            };
        },
        created() {
            var self = this;

            if (!this.new) {
                axios
                    .get('/api/partner/attribute/definition/' + this.$route.params.id)
                    .then(response => self.definition = response.data.data);
            }

            // TODO: fetch types from backend?
            // axios
            //     .get('/api/groups/list-roles')
            //     .then(response => self.roles = response.data);
        },
        methods: {
            save: function () {
                var self = this;
                if (this.new) {
                    axios
                        .post('/api/partner/attribute/definition', this.definition)
                        .then(response => self.$router.push({ name: 'admin-partner-attribute' }))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .patch('/api/partner/attribute/definition/' + this.$route.params.id, this.definition)
                        .then(response => self.$router.push({ name: 'admin-partner-attribute' }))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        }
    }
</script>
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
                            <div class="form-group">
                                <label>Attribute Machine Name</label>
                                <input
                                    v-model="definition.name"
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
                            <KeyValueField v-model="definition.options" label="Options"></KeyValueField>
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
    import KeyValueField from "../../../components/KeyValueField";

    export default {
        components: {
            KeyValueField,
            OptionList
        },
        props: ['new'],
        data() {
            return {
                definition: {
                    options: []
                },
            };
        },
        created() {
            let self = this;

            if (!this.new) {
                axios
                    .get('/api/partner/attribute/definition/' + this.$route.params.id)
                    .then(response => self.definition = response.data.data);
            }
        },
        methods: {
            save: function () {
                let self = this;
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
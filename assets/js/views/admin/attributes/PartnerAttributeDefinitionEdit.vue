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
                            <OptionListStatic
                                v-model="definition.type"
                                label="Attribute Type"
                                display-property="label"
                                :preloaded-options="allTypes"
                            ></OptionListStatic>
                            <OptionListStatic
                                v-model="definition.displayInterface"
                                label="Interface Type"
                                :preloaded-options="interfaceOptions"
                            ></OptionListStatic>
                            <KeyValueField v-if="selectedTypeHasOptions" v-model="definition.options" label="Options"></KeyValueField>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>


<script>
    import KeyValueField from "../../../components/KeyValueField";
    import {mapGetters} from "vuex";
    import OptionListStatic from "../../../components/OptionListStatic";

    export default {
        components: {
            OptionListStatic,
            KeyValueField
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
        computed: {
            ...mapGetters([
                'allTypes'
            ]),
            interfaceOptions: function () {
                let attributeType = this.$store.getters.getTypeById(this.definition.type);
                return attributeType.displayInterfaces.map(
                    (item) => { return { id: item, name: this.getInterfaceDisplayString(item)}; }
                );
            },
            selectedTypeHasOptions: function () {
                let attributeType = this.$store.getters.getTypeById(this.definition.type);
                return !!attributeType.hasOptions;
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
            },
            getInterfaceDisplayString: function (uiType) {
                let map = {
                    TEXT: 'Single Line Text Input',
                    TEXTAREA: 'Multiline Text Input',
                    NUMBER: 'Number Input',
                    DATETIME: 'Date Selector',
                    SELECT_SINGLE: 'Dropdown',
                    SELECT_MULTI: 'Multiple Select List',
                    RADIO: 'Radio Button Group',
                    CHECKBOX_GROUP: 'Checkbox Group',
                    TOGGLE: 'Yes/No Toggle',
                }

                return map[uiType];
            }
        },
        mounted() {
            this.$store.dispatch('loadTypes');
        }
    }
</script>
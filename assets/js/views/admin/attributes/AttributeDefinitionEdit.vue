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
            Edit {{ definitionEntity }} Attribute Definition
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
                            <div class="form-group">
                                <label>Help Text</label>
                                <textarea
                                    v-model="definition.helpText"
                                    class="form-control"
                                    placeholder="Enter help text"
                                />
                            </div>
                            <BooleanField
                                v-if="hasDuplicateCheck"
                                v-model="definition.isDuplicateReference"
                                label="Used when checking for duplicate records"
                            />
                            <OptionListStatic
                                v-model="definition.type"
                                label="Attribute Type"
                                display-property="label"
                                :preloaded-options="allTypes"
                            />
                            <OptionListStatic
                                v-model="definition.displayInterface"
                                label="Interface Type"
                                :preloaded-options="interfaceOptions"
                            />
                            <KeyValueField
                                v-if="selectedTypeHasOptions"
                                v-model="definition.options"
                                label="Options"
                            />
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </form>
        </div>

        <div class="panel">
            <div class="panel-heading">
                Group Types
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Group Name</th>
                            <th>Can Edit</th>
                            <th>Can View</th>
                        </thead>
                        <tbody>
                            <tr v-for="(systemGroup, index) in allSystemGroups" :key="systemGroup.id">
                                <td>{{ systemGroup.name }}</td>
                                <td>
                                    <label>
                                        <input
                                            :id="'can_edit_group_name_' + systemGroup.id"
                                            v-model="canEdit[index][systemGroup.id]"
                                            type="checkbox"
                                            :value="systemGroup.id"
                                            @change="setCanViewIfCanEdit(index, systemGroup.id)"
                                        >
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input
                                            :id="'can_view_group_name_' + systemGroup.id"
                                            v-model="canView[index][systemGroup.id]"
                                            type="checkbox"
                                            :value="systemGroup.id"
                                        >
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</template>


<script>
import KeyValueField from "../../../components/KeyValueField";
import {mapGetters} from "vuex";
import OptionListStatic from "../../../components/OptionListStatic";
import BooleanField from "../../../components/ToggleField";

export default {
        name: 'AttributeDefinitionEdit',

        components: {
            BooleanField,
            OptionListStatic,
            KeyValueField,
        },

        props: {
            newForm: {
                type: Boolean,
                default: false,
            },
            hasDuplicateCheck: {
                type: Boolean,
                default: false,
            },
            getApi: {
                type: String,
                required: true,
            },
            postApi: {
                type: String,
                required: true,
            },
            patchApi: {
                type: String,
                required: true,
            },
            listRoute: {
                type: String,
                required: true,
            },
            definitionEntity: {
                type: String,
                required: true,
            },
            data_default: {
                type: Object,
                required: false,
                default() {
                    return {};
                },
            },
        },

        data() {
            return {
                definition: {
                    options: [],
                },
                systemGroups: [],
                canEdit: [],
                canView: [],
            };
        },

        computed: {
            ...mapGetters([
                'allTypes',
                'allSystemGroups',
            ]),

            interfaceOptions: function () {
                let attributeType = this.$store.getters.getTypeById(this.definition.type);
                if (attributeType) {
                    return attributeType.displayInterfaces.map(
                        (item) => { return { id: item, name: this.getInterfaceDisplayString(item)}; }
                    );
                }
                return [];
            },

            selectedTypeHasOptions: function () {
                if (!this.definition.type) return false;

                let attributeType = this.$store.getters.getTypeById(this.definition.type);
                return !!attributeType?.hasOptions;
            },
        },

        watch: {
            allSystemGroups (newVal) {
                this.setCanEditValues();
                this.setCanViewValues();
            }
        },

        created() {
            let self = this;

            if (!this.newForm) {
                axios
                    .get(this.getApi + this.$route.params.id)
                    .then(response => self.definition = response.data.data);
            }
        },

        mounted() {
            this.$store.dispatch('loadTypes');
            this.$store.dispatch('loadSystemGroups');
        },

        methods: {
            setCanViewIfCanEdit: function(index, groupId) {
                this.canView[index][groupId] = true;
            },

            setCanEditValues: function () {
                const self = this;

                self.allSystemGroups.forEach(group => {

                    let canEditFlag = false;

                    if (self.definition && self.definition.id && group.attributeFieldPermissions) {
                        group.attributeFieldPermissions.forEach(permission => {
                            if (permission.definition_id === self.definition.id && permission.can_edit === true) {
                                canEditFlag = true;

                                return canEditFlag;
                            }
                        })
                    }

                    self.canEdit = [
                        ...self.canEdit, {
                            [group.id]: canEditFlag,
                        },
                    ]
                });
            },

            setCanViewValues: function () {
                const self = this;

                self.allSystemGroups.forEach(group => {

                    let canViewFlag = false;

                    if (self.definition && self.definition.id && group.attributeFieldPermissions) {
                        group.attributeFieldPermissions.forEach(permission => {
                            if (permission.definition_id === self.definition.id && permission.can_view === true) {
                                canViewFlag = true;

                                return canViewFlag;
                            }
                        })
                    }

                    self.canView = [
                        ...self.canView, {
                            [group.id]: canViewFlag,
                        },
                    ]
                });
            },

            save: function () {
                let self = this;

                self.definition.canEdit = self.canEdit;
                self.definition.canView = self.canView;

                if (this.newForm) {
                    axios
                        .post(this.postApi, this.definition)
                        .then((response) => {
                            self.$router.push({ name: this.listRoute })
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .patch(this.patchApi + this.$route.params.id, this.definition)
                        .then((response) => {
                            self.$router.push({ name: this.listRoute })
                        })
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
                    SELECT_SINGLE: 'Single Select List',
                    SELECT_MULTI: 'Multiple Select List',
                    RADIO: 'Radio Button Group',
                    CHECKBOX_GROUP: 'Checkbox Group',
                    TOGGLE: 'Yes/No Toggle',
                    YES_NO_RADIO: 'Yes/No Radio Options',
                    ADDRESS: 'Address',
                    ZIPCODE: 'Zip/County'
                }

                return map[uiType];
            },
        },
    };
</script>
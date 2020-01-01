<template>
    <div>
        <form role="form">
            <div
                v-for="attribute in attributes"
                :key="attribute.definition_id"
            >
                <DateField
                    v-if="attribute.type === 'DATETIME'"
                    v-model="attribute.value"
                    :label="attribute.label"
                ></DateField>
                <NumberField
                    v-else-if="attribute.type === 'INTEGER'"
                    v-model="attribute.value"
                    :label="attribute.label"
                ></NumberField>
                <NumberField
                    v-else-if="attribute.type === 'FLOAT'"
                    v-model="attribute.value"
                    :label="attribute.label"
                ></NumberField>
                <OptionListApi
                    v-else-if="attribute.type === 'OPTION_LIST'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :preloaded-options="attribute.options"
                ></OptionListApi>
                <TextField
                    v-else
                    v-model="attribute.value"
                    :label="attribute.label"
                ></TextField>
            </div>
        </form>
    </div>
</template>


<script>
    import DateField from "../../components/DateField";
    import TextField from "../../components/TextField";
    import NumberField from "../../components/NumberField";
    import OptionListApi from "../../components/OptionListApi";
    export default {
        name: 'PartnerProfileEditTab',
        components: {OptionListApi, NumberField, TextField, DateField},
        props: {
            new: { type: Boolean },
            value: { type: Object, required: true }
        },
        computed: {
            attributes: function () {
                if (this.value.profile.attributes) {
                    let attributes = this.value.profile.attributes;
                    return attributes.sort((a, b) => a.orderIndex - b.orderIndex)
                }

                return []
            }
        },
        created() {
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
        }
    }
</script>
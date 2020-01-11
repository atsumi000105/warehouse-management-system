<template>
    <div>
        <form role="form">
            <div
                v-for="attribute in attributes"
                :key="attribute.definition_id"
            >
                <DateField
                    v-if="attribute.displayInterface === 'DATETIME'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <NumberField
                    v-else-if="attribute.displayInterface === 'NUMBER'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <OptionListApi
                    v-else-if="attribute.displayInterface === 'SELECT_SINGLE'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :preloaded-options="attribute.options"
                />
                <RadioField
                    v-else-if="attribute.displayInterface === 'RADIO'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :preloaded-options="attribute.options"
                />
                <TextareaField
                    v-else-if="attribute.displayInterface === 'TEXTAREA'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <TextField
                    v-else
                    v-model="attribute.value"
                    :label="attribute.label"
                />
            </div>
        </form>
    </div>
</template>


<script>
    import DateField from "../../components/DateField";
    import TextField from "../../components/TextField";
    import NumberField from "../../components/NumberField";
    import OptionListApi from "../../components/OptionListApi";
    import TextareaField from "../../components/TextareaField";
    import RadioField from "../../components/RadioField";
    export default {
        name: 'PartnerProfileEditTab',
        components: {RadioField, TextareaField, OptionListApi, NumberField, TextField, DateField},
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
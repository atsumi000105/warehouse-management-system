<template>
    <form role="form">
        <template
            v-for="attribute in value.profile.attributes"
        >
            <DateField
                v-if="attribute.type === 'DATETIME'"
                :key="attribute.id"
                v-model="attribute.value"
                :label="attribute.label"
            ></DateField>
            <NumberField
                v-else-if="attribute.type === 'INTEGER'"
                :key="attribute.id"
                v-model="attribute.value"
                :label="attribute.label"
            ></NumberField>
            <NumberField
                v-else-if="attribute.type === 'FLOAT'"
                :key="attribute.id"
                v-model="attribute.value"
                :label="attribute.label"
            ></NumberField>
            <TextField
                v-else
                v-model="attribute.value"
                :label="attribute.label"
            ></TextField>
        </template>
    </form>
</template>


<script>
    import DateField from "../../components/DateField";
    import TextField from "../../components/TextField";
    import NumberField from "../../components/NumberField";
    export default {
        name: 'PartnerProfileEditTab',
        components: {NumberField, TextField, DateField},
        props: {
            new: { type: Boolean },
            value: { type: Object, required: true }
        },
        created() {
            if (this.new) {
                this.value.contacts.push({ isDeleted: false });
            }
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
        }
    }
</script>
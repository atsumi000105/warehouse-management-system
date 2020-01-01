<template>
    <div>
        <form role="form">
            <div
                v-for="attribute in attributes"
                :key="attribute.id"
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
    export default {
        name: 'PartnerProfileEditTab',
        components: {NumberField, TextField, DateField},
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
            if (this.new) {
                this.value.contacts.push({ isDeleted: false });
            }
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
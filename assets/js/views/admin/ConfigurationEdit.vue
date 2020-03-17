<template>
    <section class="content">
        <div class="pull-right">
            <button
                class="btn btn-success btn-flat"
                @click.prevent="save"
            >
                <i class="fa fa-save fa-fw" />
                Save Configuration
            </button>
        </div>
        <h3 class="box-title">
            Configuration
        </h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="icon fa fa-group fa-fw" />Expirations
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <OptionListStatic
                                v-model="settings.pullupCategory"
                                label="Pull-up Category"
                                :preloaded-options="getSimpleProductCategories"
                            />
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
    import { mapGetters } from 'vuex'
    import OptionListStatic from "../../components/OptionListStatic";

    export default {
        name: "ConfigurationEdit",
        components: {OptionListStatic},
        data() {
            return {
                settings: {
                    pullupCategory: ""
                }
            }
        },
        computed: {
            ...mapGetters([
                'getSimpleProductCategories',
            ]),
        },
        created() {
            let self = this;

            this.$store.dispatch('loadProductCategories');
            axios
                .get('/api/system/settings')
                .then(response => self.settings = response.data.data)
                .catch(function (error) {
                    console.log(error);
                });
        },
        methods: {
            save: function () {
                var self = this;
                axios
                    .post('/api/system/settings', this.settings)
                    .then(response => self.settings = response.data.data)
                    .catch(function (error) {
                        console.log(error);
                });
            },

        }
    }
</script>

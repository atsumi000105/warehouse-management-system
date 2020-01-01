<template>
    <section class="content">
        <div class="pull-right">
            <div class="btn-group">
                <button
                    type="button"
                    class="btn btn-default btn-flat"
                    @click.prevent="saveSort"
                >
                    <i class="fa fa-fw fa-save" />
                    Save Field Order
                </button>
            </div>
            <div class="btn-group">
                <router-link
                    :to="{ name: 'admin-partner-attribute-new' }"
                    class="btn btn-success btn-flat"
                >
                    <i class="fa fa-plus-circle fa-fw" />
                    Create Attribute
                </router-link>
            </div>
        </div>
        <h3 class="box-title">
            Partner Profile Attribute List
        </h3>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Label</th>
                                    <th>Type</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <Draggable v-model="definitions" tag="tbody">
                                <tr v-for="definition in definitions" :key="definition.id">
                                    <td><i class="fa fa-arrows"></i></td>
                                    <td><router-link :to="{ name: 'admin-partner-attribute-edit', params: {id: definition.id}}" v-text="definition.name"></router-link></td>
                                    <td v-text="definition.label"></td>
                                    <td v-text="definition.type"></td>
                                    <td v-text="definition.orderIndex"></td>
                                    <td v-text="definition.status"></td>
                                    <td>{{ definition.updatedAt | dateTimeFormat }}</td>
                                </tr>
                            </Draggable>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>

<script>
    import Draggable from 'vuedraggable';

    export default {
        components: {
            Draggable
        },
        data() {
            return {
                definitions: [],
            };
        },
        created() {
            let me = this;
            axios
                .get('/api/partner/attribute/definition')
                .then(response => me.setDefinitions(response.data.data));

        },
        methods: {
            saveSort () {
                let me = this;
                let ids = this.definitions.map( definition => definition.id );
                axios
                    .post('/api/partner/attribute/definition/order', {
                        ids: ids,
                    })
                    .then(response => me.setDefinitions(response.data.data))
            },
            setDefinitions (definitions) {
                this.definitions = definitions.sort((a, b) => a.orderIndex - b.orderIndex)
            }
        }
    }
</script>
<template>
    <section class="content">
        <router-link to="/partners/new" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle fa-fw"></i>Create Partner</router-link>
        <h3 class="box-title">Partner List</h3>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

    <!--
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
    -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Partner ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Fulfillment Period</th>
                                <th>Distribution Method</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="partner in partners.data">
                                    <td><router-link :to="'/partners/' + partner.id"><i class="fa fa-edit"></i>{{ partner.id }}</router-link></td>
                                    <td v-text="partner.title"></td>
                                    <td v-text="partner.partnerType"></td>
                                    <td v-text="partner.status"></td>
                                    <td v-text="partner.fulfillmentPeriod.name"></td>
                                    <td v-text="partner.distributionMethod ? partner.distributionMethod.name : null"></td>
                                    <td>{{ partner.updatedAt | dateTimeFormat }}</td>
                                </tr>
                            </tbody>
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
    export default {
        props:[],
        data() {
            return {
                partners: []
            };
        },
        created() {
            axios.get('/api/partners').then(response => this.partners = response.data);
            console.log('Component mounted.')
        }
    }
</script>
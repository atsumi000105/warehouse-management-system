<template>
    <div class="hb-addressform">
        <div v-if="hasTitle" class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" placeholder="Enter address name" v-model="address.title">
        </div>
        <div class="form-group">
            <label>Street 1</label>
            <input type="text" class="form-control" placeholder="Enter address name" v-model="address.street1">
        </div>
        <div class="form-group">
            <label>Street 2</label>
            <input type="text" class="form-control" placeholder="Enter address name" v-model="address.street2">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="Enter address name" v-model="address.city">
                </div>
            </div>
            <div class="col-sm-3">
                <hb-state :address="address"></hb-state>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Zip/Postal Code</label>
                    <input type="text" class="form-control" placeholder="Enter address name" v-model="address.postalCode">
                </div>
            </div>
        </div>
        <hb-country :address="address"></hb-country>
    </div>
</template>

<script>
    export default {
        props: {
            address: { type: Object, required: true },
            hasTitle: { type: Boolean, default: true },
            v: { type: Object },
        }
    }
</script>
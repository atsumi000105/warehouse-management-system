<template>
    <div class="hb-addressform">
        <div
                v-if="hasTitle"
                class="form-group"
        >
            <label>Title</label>
            <input
                v-model="address.title"
                type="text"
                class="form-control"
                placeholder="Enter address name"
            >
        </div>
        <div class="form-group">
            <label>Street 1</label>
            <input
                v-model="address.street1"
                type="text"
                class="form-control"
                placeholder="Enter address name"
            >
        </div>
        <div class="form-group">
            <label>Street 2</label>
            <input
                v-model="address.street2"
                type="text"
                class="form-control"
                placeholder="Enter address name"
            >
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>City</label>
                    <input
                        v-model="address.city"
                        type="text"
                        class="form-control"
                        placeholder="Enter address name"
                    >
                </div>
            </div>
            <div class="col-sm-3">
                <hb-state :address="address" />
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Zip/Postal Code</label>
                    <input
                        v-model="address.postalCode"
                        type="text"
                        class="form-control"
                        placeholder="Enter address name"
                    >
                </div>
            </div>
        </div>
        <hb-country :address="address" />
    </div>
</template>

<script>
export default {
    props: {
        address: { type: Object, required: true },
        hasTitle: { type: Boolean, default: true },
        v: { type: Object },
    },
};
</script>

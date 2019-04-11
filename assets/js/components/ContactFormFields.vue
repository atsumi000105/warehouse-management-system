<template>
    <div class="hb-contact">
        <div class="row">
            <div class="form-group col-xs-6">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Enter address name" v-model="contact.firstName">
            </div>
            <div class="form-group col-xs-6">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Enter address name" v-model="contact.lastName">
            </div>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" placeholder="Enter address name" v-model="contact.title">
        </div>
        <div class="row">
            <div class="form-group col-xs-6">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="Enter address name" v-model="contact.email">
            </div>
            <div class="form-group col-xs-6">
                <label>Phone</label>
                <input type="text" class="form-control" placeholder="Enter address name" v-model="contact.phoneNumber">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contact']
    }
</script>
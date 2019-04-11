<template>
    <div class="hb-addressform" v-if="value">
        <div v-if="hasTitle">
            <strong>{{value.title}}</strong><br/>
        </div>
        <div v-if="value.street1">
            {{value.street1}}<br/>
        </div>
        <div v-if="value.street2">
            {{value.street2}}<br/>
        </div>
        <div v-if="value.city || value.state || value.postalCode">
            <span v-if="value.city">
                {{value.city}},
            </span>
            <span v-if="value.state">
                {{value.state}}
            </span>
            <span v-if="value.postalCode">
                {{value.postalCode}}
            </span>
        </div>
        <div v-if="value.country">
            {{value.country}}<br/>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: { type: Object },
            hasTitle: { type: Boolean, default: false}
        }
    }
</script>
<template>
    <div class="form-group">
        <label v-text="label" />
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-2"><strong>English</strong></div>
            <div class="col-xs-2"><strong>Spanish</strong></div>
            <div class="col-xs-6"><strong>Value</strong></div>
        </div>
        <Draggable v-model="value">
            <div
                v-for="pair in value"
                :key="pair.id"
                class="row"
            >
                <div>
                    <div class="col-xs-1">
                        <i class="fa fa-arrows" />
                    </div>
                    <div class="col-xs-2">
                        <input
                            v-model="pair.name"
                            type="text"
                            class="form-control"
                            placeholder="Name"
                        >
                    </div>
                    <div class="col-xs-2">
                        <input
                            v-model="pair.nameEs"
                            type="text"
                            class="form-control"
                            placeholder="Name Spanish"
                        >
                    </div>
                    <div class="col-xs-6">
                        <input
                            v-model="pair.value"
                            type="text"
                            class="form-control"
                            placeholder="Value"
                        >
                    </div>
                </div>
            </div>
        </Draggable>
        <button @click.prevent="addBlankPair">
            Add Option
        </button>
    </div>
</template>

<script>
import Draggable from 'vuedraggable';

export default {
        name: "NameValueField",

        components: {
            Draggable,
        },

        props: {
            value: {
                type: Array,
            },
            label: {
                type: String,
            },
        },

        data() {
            return {};
        },

        methods: {
            addBlankPair: function() {
                this.value.push({
                    name: null,
                    value: null
                });
            },
        },
    };
</script>
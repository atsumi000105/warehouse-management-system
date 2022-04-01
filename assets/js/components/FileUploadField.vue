<template>
    <div :class="getFieldClass($v)">
        <label v-if="label">
            {{ label }}
            <i
                v-if="isRequired"
                class="fas fa-asterisk fa-fw text-danger"/>
        </label>
        <i
            v-if="helpText"
            v-tooltip
            :title="helpText"
            class="attribute-help-text fa fa-question-circle"
        />
        <div v-if="isValueEmpty" class="margin">
            <a :href="value.url"><i class="fa fa-download"></i> {{ value.filename }}</a> ({{ size }})
        </div>
        <input
            type="file"
            @change="onFilePicked"
            @blur="$v.$touch()"
        />
        <div v-if="isValueEmpty" class="help-block">Uploading a new file will replace the existing file.</div>
        <FieldError v-if="$v.value.$error">
            Field is required
        </FieldError>
    </div>
</template>

<script>
const filesize = require("filesize");

import {required} from 'vuelidate/lib/validators';
import FieldError from "./FieldError";

export default {
    name: "FileUploadField",

    props: {
        label: {
            type: [
                String,
                Boolean
            ],
            default: false
        },
        value: {
            type: Object,
            default: () => {}
        },
        placeholder: {
            type: String,
            required: false,
            default: ""
        },
        helpText: {
            type: String,
            required: false,
            default: ""
        },
        isRequired: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    computed: {
        size: function() { return filesize(this.value.filesize); },
        isValueEmpty: function() {return (this.value !== {} && this.value.url); }
    },

    validations() {
        return (this.isRequired) ? { value: { required } } : { value: {} };
    },

    methods: {
        onFilePicked (event) {
            const files = event.target.files;
            const fileReader = new FileReader();
            fileReader.addEventListener('load', () => {
                let data = {};
                data.filename = files[0].name;
                data.filesize = files[0].size;
                data.mimeType = files[0].type;
                data.content = fileReader.result;
                this.$emit('input', data);
            });
            fileReader.readAsDataURL(files[0]);
        },

        getFieldClass: function(v) {
            if (v.value.$error) {
                return 'form-group has-error';
            }

            return 'form-group';
        },
    }
}
</script>


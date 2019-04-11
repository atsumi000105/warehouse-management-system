<template>
    <div>
        <label v-if="label" v-text="label"></label>
        <button type="button" class="btn btn-sm btn-success pull-right" title="Add" @click="value.push(null)"><i class="fa fa-plus"></i></button>
        <table class="table table-hover table-condensed">
            <thead>
            <th v-if="keyName" v-text="keyName"></th>
            <th v-if="valueName" v-text="valueName"></th>
            </thead>
            <tbody>
            <tr v-for="(val, key) in value">
                <td v-if="keyName" v-text="key"></td>
                <td class="input-group input-group-sm">
                    <input type="text" class="form-control" v-model="value[key]"/>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger" title="Delete" @click="value.splice(key, 1)"><i class="fa fa-times"></i></button>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        props: {
            keyName: { default: false },
            valueName: { type: [String, Boolean], default: false },
            label: { type: String },
            value: { required: true },
        }
    }
</script>
<template>
    <div>
        <aside  v-for="(exception, key) in exceptions" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" @click="exceptions.splice(key, 1)"><i class="fa fa-fw fa-close"></i></button>
            <button type="button" class="close" @click="showTrace = !showTrace"><i class="fa fa-fw fa-search"></i></button>
            <h4><i class="icon fa fa-ban"></i> Exception: {{ exception.message }}</h4>
            <div v-show="showTrace">
                <ol>
                    <li v-for="line in exception.trace">{{line.file}}:{{line.line}}</li>
                </ol>
            </div>
        </aside>
    </div>
</template>

<script>
    export default {
        props:['exceptions'],
        data() {
            return {
                showTrace: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<template>
    <div>
        <div v-if="language === 'es'">
            <register-client-es></register-client-es>
        </div>
        <div v-else>
            <register-client-en></register-client-en>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            language: 'en',
        };
    },

    created() {
        const self = this;

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const language = urlParams.get('lang');

        if (language) {
            self.language = language;
        }

        console.log("ClientEdit Component mounted.");
    },
};
</script>
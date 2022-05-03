<template>
    <modal
        id="invalidModal"
        classes="modal-danger"
        :has-action="false"
    >
        <template slot="header">
            Valores Inválidos
        </template>
        <p>
            <slot>
                Existen valores invalidos en el formulario. Por favor verifica los campos e inténtalo de nuevo.
            </slot>
        </p>
        <template slot="cancelButton">
            OK
        </template>
    </modal>
</template>

<script>
import Modal from '../components/Modal.vue';

export default {
    components: {
        'modal' : Modal
    },
}
</script>

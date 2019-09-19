<template>
    <hb-modal id="invalidModal" classes="modal-danger" :has-action="false">
        <template slot="header">
            Invalid Values
        </template>
        <p>There are incorrect values in on this order. Please see error messages next to applicable fields.</p>
        <template slot="cancelButton">
            OK
        </template>
    </hb-modal>
</template>

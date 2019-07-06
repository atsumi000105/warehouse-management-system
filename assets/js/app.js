import './bootstrap';
import router from './routes';
import store from './store';

require('../sass/bootstrap.scss');
require('admin-lte/dist/css/AdminLTE.css');
require('admin-lte/dist/css/skins/skin-blue.css');
require('verte/dist/verte.css');
require('chosen-js/chosen.css');
require('chosen-bootstrap-theme/dist/chosen-bootstrap-theme.css');
require('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');
require('../sass/app.scss');

// Vue.component('vuetable', require('vuetable-2/src/components/Vuetable.vue'));
// Vue.component('vuetable-pagination', require('vuetable-2/src/components/VuetablePagination.vue'));
Vue.component('verte', require('verte/dist/verte'));

Vue.component('hb-sidebar', require('./components/Sidebar.vue').default);
Vue.component('hb-userbar', require('./components/Userbar.vue').default);
Vue.component('hb-exceptionpane', require('./components/ExceptionPane.vue').default);
Vue.component('hb-addressform', require('./components/AddressFormFields.vue').default);
Vue.component('hb-address', require('./components/AddressView.vue').default);
Vue.component('hb-contact', require('./components/ContactFormFields.vue').default);
Vue.component('hb-state', require('./components/StateField.vue').default);
Vue.component('hb-country', require('./components/CountryField.vue').default);
Vue.component('hb-modal', require('./components/Modal.vue').default);
Vue.component('hb-modalbulkchange', require('./components/ModalConfirmBulkChange.vue').default);
Vue.component('hb-modalbulkdelete', require('./components/ModalConfirmBulkDelete.vue').default);
Vue.component('hb-modalcomplete', require('./components/ModalOrderConfirmComplete.vue').default);
Vue.component('hb-modaldelete', require('./components/ModalOrderConfirmDelete.vue').default);
Vue.component('hb-modalinvalid', require('./components/ModalOrderInvalid.vue').default);
Vue.component('hb-fielderror', require('./components/FieldError.vue').default);
Vue.component('hb-date', require('./components/DateField.vue').default);
Vue.component('hb-optionlist', require('./components/OptionList.vue').default);
Vue.component('hb-optionlistraw', require('./components/OptionListRaw.vue').default);
Vue.component('hb-optionliststatic', require('./components/OptionListStatic.vue').default);
Vue.component('hb-arraytableform', require('./components/ArrayTableForm.vue').default);
Vue.component('hb-ordermetadatabox', require('./components/OrderMetadataBox.vue').default);
Vue.component('hb-lineitemform', require('./components/LineItemForm.vue').default);
Vue.component('hb-lineitemformrow', require('./components/LineItemFormRow.vue').default);
Vue.component('hb-lineitemtransactions', require('./components/LineItemTransactionTable.vue').default);
Vue.component('hb-productselection', require('./components/ProductSelectionField.vue').default);
Vue.component('hb-storagelocationselectionform', require('./components/StorageLocationSelectionForm.vue').default);
Vue.component('hb-supplierselectionform', require('./components/SupplierSelectionForm.vue').default);
Vue.component('hb-tablepaged', require('./components/TablePaged.vue').default);
Vue.component('hb-fillsheet', require('./components/FillSheet.vue').default);
Vue.filter('dateFormat', require('./filters/dateFormat'));
Vue.filter('dateTimeFormat', require('./filters/dateTimeFormat'));
Vue.filter('dateTimeMonthFormat', require('./filters/dateTimeMonthFormat'));
Vue.filter('numberFormat', require('./filters/numberFormat'));
Vue.filter('currencyFormat', require('./filters/currencyFormat'));
Vue.filter('orderStatusFormat', require('./filters/orderStatusFormat'));

Vue.directive('chosen', {
    inserted: function(el, binding, vnode) {
        jQuery(el).chosen({disable_search_threshold: 10}).change(function(event, change) {
            vnode.data.on.change(event, $(el).val());
        });
    },
    componentUpdated: function(el, binding) {
        jQuery(el).trigger("chosen:updated");
    }
});

Vue.directive('tooltip', {
    inserted: function(el, binding, vnode) {
        jQuery(el).tooltip({
            placement: binding.value
        });
    }
});

Vue.directive('datepicker', {
    inserted: function(el, binding, vnode) {
        binding.value = binding.value || {};
        let format = binding.value.format || 'YYYY-MM-DD';
        let value = moment($(el).val(), format);

        if (binding.value.tz || false) {
            value.tz(binding.value.tz);
        }
        jQuery(el).datetimepicker({
            format: format
        }).on('dp.change', function (e) {
            vnode.data.on.change(e, e.date);
        });
        $(el).data('DateTimePicker').date(value);
    },
    componentUpdated: function(el, binding) {
        binding.value = binding.value || {};
        let format = binding.value.format || 'YYYY-MM-DD';
        let value = moment(el.value, format);
        if (binding.value.tz || false) {
            value.tz(binding.value.tz);
        }
        jQuery(el).data("DateTimePicker").date(value);
    }
});

window.App = new Vue({
    el: '#app',
    data: {
        exceptions: []
    },
    router,
    store
});

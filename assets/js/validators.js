// Make sure at least one line item has a non-zero quantity
import {value} from "lodash/seq";

export const linesRequired = (value) =>
    value.reduce(function (valid, line) {

        let defaultPackSize = 25;

        let skipCondition = false;

        if (value.partnerType &&
            value.partnerType === 'HOSPITAL' &&
            line.product.hospitalPackSize) {
            defaultPackSize = line.product.hospitalPackSize;
            skipCondition = true;
        }

        if (skipCondition && line.product.agencyPackSize) {
            defaultPackSize = line.product.agencyPackSize;
        }

        if (line.quantity === 0) {
            valid = true;
        }

        return valid ? valid : Boolean(line.quantity % defaultPackSize == 0);
    }, false);

import {withParams} from 'vuelidate/lib/validators';

export const mod = divisor => withParams(
    { type: 'mod', d: divisor },
    value => value.quantity % d == 0
);

export const mustLessThanNow = (value) => (value ? moment(value) < new Date() : false)
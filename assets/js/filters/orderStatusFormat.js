module.exports = function (status) {
    if (status == null) return null;
    status = status.replace('_',' ').toLowerCase();
    return status.charAt(0).toUpperCase() + status.slice(1);
};
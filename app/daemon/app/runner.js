global._path = (path) => {

};

const config = require('@root/configs/schema.json');
const vendorFactory = require('@vendors/factory.js');

module.exports = () => {
    const vendorsPull = config.vendors.map(vendor => vendorFactory(vendor));

    console.log(vendorsPull);
};
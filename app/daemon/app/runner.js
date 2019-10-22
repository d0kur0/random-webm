const path = require('path');
global.rootPath = relativePath => path.join(__dirname, relativePath);

const schema = require(rootPath('configs/schema.json'));
const vendorFactory = require(rootPath('vendors/factory.js'));

module.exports = () => {
    const vendorsPull = schema.vendors.map(vendor => vendorFactory(vendor));

    console.log(vendorsPull);
};
const fileSystem = require('fs');
const path = require('path');

module.exports = (vendor) => {
	const vendorFile = path.join(__dirname, `/vendors/${vendor.name}.js`);

	if (!fileSystem.existsSync(vendorFile)) {
		throw new Error(`Supplier implementation: "${vendor.name}" not found`);
	}

	return require(vendorFile)(vendor);
};
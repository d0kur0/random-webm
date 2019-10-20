module.exports = (vendorName) => {
	const vendorFile = `./vendors/${vendorName}.js`;

	if (!fileSystem.existsSync(vendorFile)) {
		throw new Error(`Supplier implementation: "${vendorName}" not found`);
	}
};
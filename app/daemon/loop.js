const runner = require('./app/runner.js');

try {
    runner();
} catch (e) {
    console.error(e.message)
}
// #!/usr/bin/env node

var SphinxClient = require ("../node-sphinxapi/lib/sphinxapi.js"),
	util = require('util'),
	assert = require('assert');

var cl = new SphinxClient();
cl.SetServer('localhost', 19312);
cl.SetFieldWeights({
    title: 15000,
    content: 30000
});
cl.SetMatchMode(SphinxClient.SPH_MATCH_EXTENDED);
cl.Query('test', function(err, result) { 
		assert.ifError(err);
		console.log(util.inspect(result, false, null, true));
});


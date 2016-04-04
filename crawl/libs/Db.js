var config  = require(__dirname + '/../configs/config.js');
var mysql   = require('mysql');
var squel   = require("squel");

var Db = function()
{
	this.adapter = mysql.createPool(config.mysql);
};

Db.prototype.query = function(sql, callback)
{
	this.adapter.getConnection(function(error, connection) {
		if( error ){
			console.log('Connecttion Error: ', error);
			return;
		}
		connection.query(sql.text, sql.values, function(err, rows) {
			if( err )
			{
				console.log('Error: ', err);
				return;
			}
			connection.release();
			callback(err, rows);
		});
	});
};

module.exports = Db;
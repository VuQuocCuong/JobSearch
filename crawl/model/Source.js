var squel   = require("squel");
var config  = require(__dirname + '/../configs/config.js');
var Db      = require(__dirname + "/../libs/Db");

var Source = function()
{
    this.db = new Db();

    this.STATE      = {
        IDLE        : 'IDLE',
        UPDATING    : 'UPDATING',
        ERROR       : 'ERROR'
    };
};

Source.prototype.loadSource = function(callback)
{
    var sql = squel.select()
            .from(config.tableSource)
            .where("status = 'RUN'")
            .where("state = 'IDLE'")
            .toParam();
    this.db.query(sql, callback);
};

Source.prototype.updateUpdatedAtToSource = function(id_source, callback)
{
    var where = "id_source = " + id_source;
    var sql = squel.update()
            .table(config.tableSource)
            .set("updated_at", new Date().getTime()/1000 |0)
            .where(where)
            .toParam();
    this.db.query(sql, callback);
};

module.exports = Source;
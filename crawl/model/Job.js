var squel   = require("squel");
var util    = require('util');
var mysql   = require("mysql");
var config  = require(__dirname + '/../configs/config.js');
var Db      = require(__dirname + "/../libs/Db");

var Job = function()
{
    this.db         = new Db();
    this.tableName  = "job";
    this.squelMysql = squel.useFlavour('mysql');
};

Job.prototype._buildJobTile = function(string)
{
    if (!string || !string.length)
    {
        return null;
    }
    var array       = string.split(' ');
    var arrarTitle  = [];

    for(var i=0; i<15; i++)
    {
        if (array[i])
        {
            arrarTitle.push(array[i]);
        }
    }
    var title = arrarTitle.join(' ');
    return title;
};

Job.prototype._buildDataToInsert = function(fbData)
{
    var data        = {};
    var id_source   = "";
    var title       = "";

    if (util.isArray(fbData))
    {
        var arrData        = [];
        for (var i=0; i<fbData.length; i++)
        {
            title       = this._buildJobTile(fbData[i].message);
            id_source   = fbData[i].id.split('_')[0];
            var item    = {
                "id_social"     : fbData[i].id,
                "id_source"     : id_source,
                "title"         : title,
                "message"       : fbData[i].message,
                "author"        : fbData[i].from.id,
                "author_name"   : fbData[i].from.name,
                "created_at"    : fbData[i].created_time
            };
            if (item.id_social && item.id_source && item.message && item.created_at)
            {
                arrData.push(item);
            }
        }
        return arrData;
    }
    else
    {
        title       = this._buildJobTile(fbData.message);
        id_source   = fbData.id.split('_')[0];

        data    = {
            "id_social"     : fbData.id,
            "id_source"     : id_source,
            "title"         : title,
            "message"       : fbData.message,
            "author"        : fbData.from.id,
            "author_name"   : fbData.from.name,
            "created_at"    : fbData.created_time
        };
        return data;
    }
};

Job.prototype.insert = function(fbData, callback)
{
    var data    = this._buildDataToInsert(fbData);
    var sql     = this.squelMysql.insert()
                .into(this.tableName)
                .set("id_social", data.id_social)
                .set("id_source", data.id_source)
                .set("title", data.title)
                .set("message", data.message)
                .set("author", data.author)
                .set("author_name", data.author_name)
                .set("created_at", data.created_at)
                .onDupUpdate("id_social", data.id_social)
                .toParam();
    this.db.query(sql, callback);
};

Job.prototype.multipleInsert = function(arrFbData, callback)
{
    var arrData = this._buildDataToInsert(arrFbData);
    var sql     = this.squelMysql.insert()
                .into(this.tableName)
                .setFieldsRows(arrData)
                .toParam();
    sql.text    = sql.text.replace('INSERT', 'INSERT IGNORE');
    this.db.query(sql, callback);
};

module.exports = Job;
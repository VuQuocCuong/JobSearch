var config  = require(__dirname + '/configs/config.js');
var Db      = require(__dirname + "/libs/Db");
var FB      = require(__dirname + "/libs/Facebook");
var Source  = require(__dirname + "/model/Source.js");
var Job     = require(__dirname + "/model/Job.js");

var Script = function()
{
    this.sourceModel          = new Source();
    this.fbModel              = new FB();
    this.jobModel             = new Job();
    
    this.lifecycle            = 1800000;
    this.arrSource            = [];

    this.loadSourceReq        = 0;
    this.loadSourceRes        = 0;
    this.loadSourceErr        = 0;

    this.getPostInfoReq       = 0;
    this.getPostInfoRes       = 0;
    this.getPostInfoErr       = 0;
};

Script.prototype.start = function()
{
    this.loadSource();
    this.getPostFromSource();
    this.showInfo();
};

Script.prototype.loadSource = function()
{
    console.log('Load Source!');
    this.loadSourceReq++;
    this.sourceModel.loadSource(function(error, data)
    {
        this.loadSourceRes++;
        if (error)
        {
            this.loadSourcesErr++;
            console.log('loadSource | error: ', error);
            return;
        }
        if ( !(data instanceof Array) || !data.length )
        {
            return;
        }
        var source = null;
        for(var i = 0; i < data.length; i++)
        {
            source = data[i];
            this.arrSource.push(source);
        }
    }.bind(this));
    setTimeout(this.loadSource.bind(this), this.lifecycle);
};

Script.prototype.canGetPostFromSource = function()
{
    if( !this.arrSource.length )
    {
        return false;
    }
    if( this.loadSourceReq > this.loadSourceRes )
    {
        return false;
    }
    return true;
}
Script.prototype.getPostFromSource = function()
{
    if( !this.canGetPostFromSource() )
    {
        console.log('Wait source...');
        setTimeout(this.getPostFromSource.bind(this), 15000);
        return;
    }
    var source = this.arrSource.shift();
    this.doGetPostFromSource(source);
    setTimeout(this.getPostFromSource.bind(this), 15000);
};

Script.prototype.doGetPostFromSource  = function(source)
{
    this.getPostInfoReq++;
    this.fbModel.getPostData(source, function(error, fbData)
    {
        this.getPostInfoRes++;
        if (error)
        {
            this.getPostInfoErr++;
            console.log("doGetPostFromSource || error", source.id_source, error);
            return;
        }
        this.updateSource(source);
        this.insertJobToDb(fbData.data);
    }.bind(this));
};

Script.prototype.updateSource  = function(source)
{
    this.sourceModel.updateUpdatedAtToSource(source.id_source, function(error, res)
    {
        console.log("updateUpdatedAtToSource: ", error, res);
        return;
    });
};

Script.prototype.insertJobToDb = function(data)
{
    this.jobModel.multipleInsert(data, function(error, res)
    {
        console.log("insertJobToDb: ", error, res);
        return;
    });
};

Script.prototype.showInfo = function()
{
    console.log('------------------------------------');
    console.log("loadSourceReq: ", this.loadSourceReq);
    console.log("loadSourceRes: ", this.loadSourceRes);
    console.log("loadSourceErr: ", this.loadSourceErr);
    console.log('------------------------------------');
    console.log("loadSourceReq: ", this.getPostInfoReq);
    console.log("loadSourceRes: ", this.getPostInfoRes);
    console.log("loadSourceErr: ", this.getPostInfoErr);
    console.log('====================================');
    setTimeout(this.showInfo.bind(this), this.lifecycle);
};

var script = new Script();
script.start();
var config  = require(__dirname + '/../configs/config.js');
var graph   = require('fbgraph');
var _       = require('lodash');
graph.setAccessToken(config.accset_token);

var Facebook    = function()
{
    this.data       = null;
    this.limit      = 25;
    this.param      = {
        fields  : "id, from, to, link, created_time, likes, comments, message",
        limit   : 25
    };
    this.sourceActive = {};
};

Facebook.prototype.getPostData = function(source, callback)
{
    if ( _.isObject(source) )
    {
        this.sourceActive = source;
        console.log('---------------------------------');
        console.log('Begin source: ', source.id_source);
        graph.get(source.id_source + "/feed", this.param,  function(error, res) {
            if (error ){
                callback(error);
                return;
            }
            if (this.canGetPostData(this.sourceActive, res))
            {
                setTimeout(this.getPostData(res.paging.next, callback), 2000);
                callback(null, res);
            }
            else
            {
                console.log("End of source");
                return;
            }
        }.bind(this));
    }
    else
    {
        graph.get(source, function(error, res) {
            if (error ){
                callback(error);
                return;
            }
            if (this.canGetPostData(this.sourceActive, res))
            {
                setTimeout(this.getPostData(res.paging.next, callback), 2000);
                callback(null, res);
            }
            else
            {
                console.log("End of source");
                return;
            }
        }.bind(this));
    }
};

Facebook.prototype.canGetPostData = function(source, resFb)
{
    if (!resFb)
    {
        return false;
    }
    if (!resFb.paging || !resFb.paging.next){
        return false;
    }
    if (resFb.length < this.limit)
    {
        return false;
    }
    if (source.type == "PAGE")
    {
        if ( source.updated_at > new Date(resFb.data[resFb.data.length - 1].created_time).getTime()/1000 ){
            return false;
        }
    }
    else
    {
        if ( source.updated_at > new Date(resFb.data[resFb.data.length - 1].updated_time).getTime()/1000 ){
            return false;
        }
    }
    return true;
};

module.exports = Facebook;
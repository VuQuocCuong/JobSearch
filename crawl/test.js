var config  = require(__dirname + '/configs/config.js');
var Db      = require(__dirname + "/libs/Db");
var Fb      = require(__dirname + "/libs/Facebook");
var Job     = require(__dirname + "/model/Job");

var db      = new Db();
var fb      = new Fb();
var jobModel    = new Job();

fb.getPostData({'id_source': '653629591331742'}, function(error, fbData)
{
    if (error)
    {
        console.log("getPostData || error", error);
        return;
    }
    jobModel.multipleInsert(fbData.data, function(error, res)
    {
        console.log("Insert job to db: ", error, res);
        return;
    });
});

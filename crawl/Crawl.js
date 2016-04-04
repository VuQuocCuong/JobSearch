var config  = require(__dirname + '/configs/config.js');
var Db      = require(__dirname + "/libs/Db");
var FB      = require(__dirname + "/libs/Facebook");
var Source  = require(__dirname + "/source.js");
var Job     = require(__dirname + "/Job.js");

var fbModel = new FB();

var Crawl = function()
{
    this.sourceModel          = new Source();
    
    this.updateDataToDbReq    = 0;
    this.updateDataToDbRes    = 0;
    this.updateDataToDbErr    = 0;

    this.lifecycle            = 15;
    this.arrTopics            = [];
};

Crawl.prototype.start = function()
{
    console.log('begin!');
    this.loadSource();
    this.showInfo();
};

Crawl.prototype.showInfo = function()
{
    console.log('begin!');
};

Crawl.prototype.loadSource = function()
{
    this.sourceModel.loadSource(function(error, source)// cho nay nen return luon ca 1 cai row (object) ve luon thi de dung hon
    {
        if (error) {
            console.log(error);
            return;
        }
        console.log(source);
        this.getDataFromSource(source);
    });
};

Crawl.prototype.getDataFromSource = function(source)
{
    console.log('load source:', source.id_source);
    // Cho nay ong dung graph api, load data tu facebook
    // Tao ra 1 cai fb model, tuong tu voi source model, nhung thay vi connect toi db thi connect toi facebook de lay data
    
    // Tao bien options, de luu thong tin page ma minh can xu li. 
    var options= {};
    if (source.nextPageData) // cai bien nextPageData tuong trung thoi, ong co the xu li theo cach cua ong
    {
        // options = nextPageData
    }
    this.fbModel.loadPost(
        source.id_source,
        options,
        this.onGetDataFromSource.bind(this, source)
    );
    return;
};

Crawl.prototype.onGetDataFromSource = function(source, err, res)// tuong tu
{
    if (err)
    {
        console.log('onGetDataFromSource | err:', err);
        // @TODO: retry.
        return;
    }

    // parse res tu facebook sang dang cau truc ma ong muon luu tru sang db.
    // Dong thoi cung loai bo bot nhung data khong muon lay.
    var result = []; // result l array data cuoi cung

    // check xem ket qua tra ve. Boi vi facebook tra ve theo tung page, moi page default la 25 item.
    // Do do can check xem co can tiep tuc load page ke tiep hay khong.
    if (result.length)
    {
        // Vao trong nay nghia la con data de load tiep.
        // Nhu vay can parse thong tin tu res cua facebook de biet duoc page ke tiep cua facebook la gi de request.
        // "paging": {
          //   "previous": "https://graph.facebook.com/v2.2/496084250470559/feed?fields=id,message&limit=3&format=json&since=1448453964&access_token=CAACEdEose0cBANMxT02vEh0nWFgmOiJrR4WGZAo7YBUMbZCJcsVLqgsLXpwObfLdIweEQOZBazDCxAy4c1G4d39UOe85NB4qaj0ZA6zE7Vi04nDxNcGEcrc2954FiWylBsXLnu2UneRmoYT52aC2jvxkAbYwd0xYanwkEFhd5fcZAZAQTz8MnDootvJ4xabxEBy2gqyyouDWYWgzZAVvVlx&__paging_token=enc_AdCZADen7IGgwQ3ed2lvFgtvvHGZBbiN5Oo9tQcp9QD4F61WhpZCebC1ZBsrURM5p7bvG2gGwp0DHtVTnY3g0g21yNyDeOZB4J5blRDZBqWGHdghNXFAZDZD&__previous=1",
          //   "next": "https://graph.facebook.com/v2.2/496084250470559/feed?fields=id,message&limit=3&format=json&access_token=CAACEdEose0cBANMxT02vEh0nWFgmOiJrR4WGZAo7YBUMbZCJcsVLqgsLXpwObfLdIweEQOZBazDCxAy4c1G4d39UOe85NB4qaj0ZA6zE7Vi04nDxNcGEcrc2954FiWylBsXLnu2UneRmoYT52aC2jvxkAbYwd0xYanwkEFhd5fcZAZAQTz8MnDootvJ4xabxEBy2gqyyouDWYWgzZAVvVlx&until=1448445988&__paging_token=enc_AdDJJdFwfiHZAIYSZAjN3gAyvwd3HHZB7ZA67Q5kjBDt9h8hmHm0w896iJqqFxeYh2jWmHpx418AhvoZCnjPxzq4d2d0r2AWMe5w28LLSMO1U3uxgQwZDZD"
          // }
          // => cai paging.next la thong tin cua page ke tiep ak. Tim cach load no de tiep tuc request load data.
          // source.nextPageData  = ...;
        
        // Gio chi con mot buoc la insert post vo db. Minh lam buoc do o day luon di:
        // 1. Inert post vo db.
        // 2. insert xong thi moi tiep tuc load next page. 
        this.itemModel.insert(result, function(err, res){
            if (err)
            {
                console.log('insert | err', err);
                // @TODO: retry.
                return;
            }
            this.getDataFromSource(source);
        });
        
        return;
    }

    // xuong toi day nghia la load xong page roi ak.
    // Update thong tin page xuong db.
    this.sourceModel.updateSourceLastData(source, function(err, res) {
        console.log('updateSourceLastData', err, res);
    });
};


// Thuong trong script khong hay dung export lam,
// No chu yeu dung cho model thoi. DUng trong ngu canh viet ra 1 cai gi do cho thang khac xai ak.
// module.exports = Crawl;

// ong chay script no ko console ra gi het
// la do ong viet script, chi tao class cho no ma khong khoi dong no.

// Gio muon chay nhung ham do, thi ong phai tu goi.
// Cu tuong tuong nhu la ong dang khai bao fucntion ak.
function showText(text){
console.log(text);
}
// => thi tu no se khong chay. ong phai goi thi no moi chay:
// vd nhe: comment lai => khong ra gi het
// // bo comment ra => gio no moi chay.
// showText('123');

// Tuong tu cho var Crawl = function()
// => muon chay no thi phai goi no ra.
// Crawl();
// Nhung trong truong hop cu the cua minh, minh khong muon su dung Crawl nhu mot function, ma minh muon su dung no nhu mot class
// De tu do ke thua, va khai bao cac ham con. Do do minh se viet:
var script = new Crawl(); // No tuong duong voi goi Crawl, nhung dong thoi cung tra ve mot object, thua ke nhung property cua prototype cua Crawl.
// console.log(script.start); // ra Function. function do la cai start ak

// Thu goi ham test cua Class Crawl:
// script.test();// ra begin.
// do do cho nay muon chay ham start thi goi
script.start();
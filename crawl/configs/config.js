var config = exports;

config.base_path    = __dirname + '/..';
config.libs_path    = config.base_path + '/libs';
config.logs_path    = config.base_path + '/logs';
config.configs_path = config.base_path + '/configs';

config.mysql        = {
    host            : 'localhost',
    user            : 'root',
    password        : '',
    database        : 'socialjob'
};

config.tableSource  = "source";
config.tableJob     = "job";

config.accset_token = "CAAFw6jeHF3UBAK8f8Ncduh9YWv01oqQUElpusIhlIu6f4gbUh6g8i0GYifTAedap7DE1AdZAthBGD50NOZAqYdHAbtfF65LFFfWWZA0nZCkrFub5tfOrI5OZCAsjxcHFvzQ3x9Wo0Y1bh4C4UAXicQZC74HTZBB5HNrD7i3UIpxdVdO0sxnFAc3";
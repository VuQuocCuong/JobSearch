var config = exports;

config.base_path    = __dirname + '/..';
config.libs_path    = config.base_path + '/libs';
config.logs_path    = config.base_path + '/logs';
config.configs_path = config.base_path + '/configs';

config.mysql        = {
    host            : 'localhost',
    user            : 'root',
    password        : '',
    database        : 'jobsearch'
};

config.tableSource  = "source";
config.tableJob     = "job";

config.accset_token = "EAAFw6kU8nN4BALDqZChEOwLNmKontcD3Y4soHtanJBxbKEfQ0FmIrLoKOJSfzWRPDlOub6SC5HzOtrSn3hFpXoxt6uQpKMVvPmoDKxH0y210VhZBMAZBBqJwxTZBNb04NXrX0XqF21X8aZBnCAEIb2yhutPVhg6IZD";

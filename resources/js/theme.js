window._ = require('lodash');

try {
    window.bootstrap=require('bootstrap');
    window.$=window.jQuery=require('jquery');
} catch (e) {}

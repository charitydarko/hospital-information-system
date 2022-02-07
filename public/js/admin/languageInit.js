"use strict";
var _baseURL = $('#__site-base-url').attr('data-base-url');

var langConfig = $.ajax({type: "GET", url: _baseURL+'dashboard/getLanguage', async: false}).responseText;
var _langConfig = JSON.parse(langConfig);

<?php
//配置文件
return [
	'http_exception_template'    =>  [
	    // 定义404错误的重定向页面地址
	    404 =>  APP_PATH.'404.html',
	    // 还可以定义其它的HTTP status
	    401 =>  APP_PATH.'401.html',
	]
];
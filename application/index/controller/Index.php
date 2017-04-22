<?php
namespace app\index\controller;
use app\common\controller\Homebase;
use think\Db;
class Index extends Homebase
{
    public function index()
    {
    	echo '<h1>前台</h1>';
    }
}

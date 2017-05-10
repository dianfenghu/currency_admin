<?php
namespace app\admin\validate;
use think\Validate;

class Content extends Validate
{
	   protected $rule = [
        'title'  =>  'require|max:25',
        'type' =>  'require',
        'content' =>  'require',
       // 'photo' =>  'require',
    ];

	   
    protected $message = [
        'title.require' => '文章标题不能为空',
        'type' => '请选择文章分类',
		'content' => '文章正文不能为空',
	//	'photo' => '请先上传文章缩略图'
    ];


}
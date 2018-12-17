<?php

namespace app\api\controller;

use \think\Db;

class Childtrack extends Base
{

	private $return = array(
        'msg' => 'success',
        'code' => 1,
        'data' => ''
    );

	public function index()
	{
		return 'dario';
	}

	public function getAlbumByid()
	{
		$where['album_id'] = 16857278;
		$result = Db::name('child_album')->where($where)->select();
		$this->return['data'] = $result;
        return json($this->return);
	}
	
	public function getLastestAlbum()
	{
		
	}

}
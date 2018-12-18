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

	public function getRecommend()
	{
		$ret = array();
		$slider = Db::name('child_album')->field('album_id, name, cover')->order('updateDate desc')->limit(5)->select();
		$ret['slider'] = $slider;

		$gushi = Db::name('child_album')->alias('a')->field('a.album_id, a.name, a.cover, a.intro')->join('child_album_tag b', 'a.album_id = b.album_id', 'LEFT')->where('b.tag_id = 1')->limit(3)->select();
		foreach ($gushi as &$v) {
			$v['intro'] = strip_tags($v['intro']);
		}
		// $erge;
		// $donghua;
		// $kepu;
		// $mingzhu;
		// $guoxue;
		// $yingyu;
		// $huiben;
		// $jiajiao;
		// $muying;
		$this->return['data'] = $gushi;
		return json($this->return);
	}

}
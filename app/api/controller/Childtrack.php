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
		$slider = Db::name('child_album')->field('album_id as id, name, cover as picUrl')->order('updateDate desc')->limit(5)->select();
		$ret['slider'] = $slider;
		$tag_map = array(
			'gushi' => 1,
			'donghua' => 63,
			'kepu' => 6,
			'mingzhu' => 43,
			'guoxue' => 74,
			'yingyu' => 72,
			'huiben' => 46,
			'jiajiao' => 5,
			'erge' => 2,
		);

		foreach ($tag_map as $k => $v) {
			$ret[$k] = Db::name('child_album')->alias('a')->field('a.album_id, a.name, a.cover, a.intro')->join('child_album_tag b', 'a.album_id = b.album_id', 'LEFT')->where('b.tag_id = '.$v)->order('a.updateDate desc')->limit(3)->select();
			foreach ($ret[$k] as &$va) {
				$va['intro'] = strip_tags($va['intro']);
			}
		}
		
		$this->return['data'] = $ret;
		return json($this->return);
	}

}
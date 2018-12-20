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
			'gushi' => array(1,'故事'),
			'donghua' => array(63,'动画'),
			'kepu' => array(6,'科普'),
			'mingzhu' => array(43,'名著'),
			'guoxue' => array(74,'国学'),
			'yingyu' => array(72,'英语'),
			'kexue' => array(48,'科学'),
			'jiajiao' => array(5,'家教'),
			'erge' => array(2,'儿歌'),
		);

		foreach ($tag_map as $k => $v) {
			$tmp = array();
			$tmp['tag_id'] = $v[0];
			$tmp['tag_name'] = $v[1];
			$tmp['data'] = Db::name('child_album')->alias('a')->field("a.album_id, a.name, a.cover, a.intro" )->join('child_album_tag b', 'a.album_id = b.album_id', 'LEFT')->where('b.tag_id = '.$v[0])->order('a.updateDate desc')->limit(3)->select();
			foreach ($tmp['data'] as &$va) {
				if (strlen($va['name']) > 8) {
					$va['name'] = mb_substr($va['name'], 0, 8, 'utf-8') . '...';
				}
				$va['intro'] = strip_tags($va['intro']);
				if (strlen($va['intro']) > 16) {
					$va['intro'] = mb_substr($va['intro'], 0, 16, 'utf-8') . '...';
				}
			}
			$ret['tag_list'][] = $tmp; 
		}
		
		$this->return['data'] = $ret;
		return json($this->return);
	}

}
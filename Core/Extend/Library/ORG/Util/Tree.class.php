<?php 
// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough. 
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.7.7
// +---------------------------------------------------------------------------------------------------
// | Description: 树形类
// +---------------------------------------------------------------------------------------------------
// 

	class Tree{
		//传入数组
		public $arr = array();
		//树形结构符号
		public $icon = array();
		//多维数组
		public $list = array();
		//tree  二维数组
		public $tree = array();
		//nav 面包屑
		public $nav = array();
		//$id字段
		public $id = '';
		//$pid字段
		public $pid = '';
		//根id
		public $root = 0;
		//子类索引
		public $index_child = 'child';
		//树形图标
		public $icons = array('body'=>'|','branch'=>'├','end'=>'└');
		//前缀
		public $prefix = 'prefix';
		//构造
		public function __construct($arr = null,$root = 0,$id = 'id',$pid = 'pid'){
			if(empty($arr)){
				return false;
				exit;
			}

			$this->id = $id;
			$this->pid = $pid;
			$this->root = $root;
			$this->arr = $arr;

		}

		//获取父类 （追溯） ps：面包屑
		public function get_nav($id = null){
			if(empty($id)){
				exit('ID必须');
			}
			$this->create_nav($id);
			return $this->nav;
		}

	    //创建面包屑
	    public function create_nav($id){
	    	foreach ($this->arr as $v) {
	    		if($v[$this->id] == $id){
	    			$this->nav[] = $v;
	    			$this->create_nav($v['pid']);
	    		}
	    	}
	    }


		//获取子类（一层）
		public function get_child($pid = null){
			$pid = empty($pid)?$this->root:$pid;
			$rst = array();

			foreach ($this->arr as $k => $v) {
				if($v[$this->pid] == $pid){
					$rst[] = $v;
				}
			}

			return $rst;
		}


		//获取数组 （多层嵌套）
		public function get_list($pid = null){
			$pid = empty($pid)?$this->root:$pid;

			$this->transition_array();

			//如果元素有父ID大于0,则放入父元素中（引用本身）
			foreach ($this->arr as $k => $v) {
				if($v[$this->pid] > 0){
					$this->arr[$v[$this->pid]][$this->index_child][$v[$this->id]] = &$this->arr[$v[$this->id]];
				}
			}

			//根据根ID取有用数组
			foreach($this->arr as $v){
				if($v[$this->pid] == $pid){
					$this->list[$v[$this->id]] = $v;
				}
			}

			return $this->list;
		}

		//转换数组
		public function transition_array(){
			$arr = array();
			foreach($this->arr as $v){
				$arr[$v[$this->id]] = $v;
			}
			$this->arr = $arr;
		}
		
		//获取树形数组
		public function get_tree($pid = null){
			$pid = empty($pid)?$this->root:$pid;
			$this->create_tree($pid);
			return $this->tree;
		}

		//创建树形
		public function create_tree($pid,$level=0){
			//根据父节点找寻子节点
			$arr = array();
			$arr = $this->get_child($pid);
			if(is_array($arr)){
				//判断子节点前缀
				$count = count($arr);
				// array('body'=>'|','branch'=>'├','end'=>'└');

				for($i = 0;$i<$count;$i++){
					if($i == $count-1){
						$arr[$i][$this->prefix] = $count>0?str_repeat($this->icons['body']."&nbsp;", $level).$this->icons['end']:$this->icons['end'];
					}else{
						$arr[$i][$this->prefix] = $count>0?str_repeat($this->icons['body']."&nbsp;", $level).$this->icons['branch']:$this->icons['branch'];
					}
					$this->tree[] = $arr[$i];
					//递归
					$this->create_tree($arr[$i]['id'],$level+1);
				}
			}
		}

	}
// +---------------------------------------------------------------------------------------------------
// |End of file Tree.php
// |Location: ./Tree.php
// +---------------------------------------------------------------------------------------------------

//测试
// $arr  = array(
// 					0 => array(
// 						'id' => '1',
// 						'pid' => '0',
// 						'name' => 'levelOne-1',
// 						),
// 					1 => array(
// 						'id' => '2',
// 						'pid' => '0',
// 						'name' => 'levelOne-2',
// 						),
// 					2 => array(
// 						'id' => '3',
// 						'pid' => '1',
// 						'name' => 'levelTwo-1',
// 						),
// 					3 => array(
// 						'id' => '4',
// 						'pid' => '1',
// 						'name' => 'levelTwo-2',
// 						),
// 					4 => array(
// 						'id' => '5',
// 						'pid' => '4',
// 						'name' => 'levelThree-1',
// 						),
// 					5 => array(
// 						'id' => '6',
// 						'pid' => '3',
// 						'name' => 'levelThree-2',),
// 					6 => array(
// 						'id' => '7',
// 						'pid' => '3',
// 						'name' => 'levelThree-3',),
// 					7 => array(
// 						'id' => '8',
// 						'pid' => '3',
// 						'name' => 'levelThree-4',),
// 					8 => array(
// 						'id' => '9',
// 						'pid' => '4',
// 						'name' => 'levelThree-4',),
// 					9 => array(
// 						'id' => '10',
// 						'pid' => '4',
// 						'name' => 'levelThree-4',),
// 				);

// $tree = new Tree($arr);
// echo '<pre>';

// // $list = $tree->get_tree();
// // echo '<ul>';
// // foreach($list as $v){
// // 	echo '<li>';
// // 	echo $v['prefix'].$v['name'];
// // 	echo '</li>';
// // }
// // echo '</ul>';

// print_r($tree->get_nav(10));
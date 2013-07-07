<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough. 
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.4.23
// +---------------------------------------------------------------------------------------------------
// | Description: 通用树形类+无限级分类
// +---------------------------------------------------------------------------------------------------

/*
 * Example
 * 
  $arr = array(
  => array('id' => '1', 'pid' => 0, 'name' => '一级栏目一'),
  => array('id' => '2', 'pid' => 0, 'name' => '一级栏目二'),
  => array('id' => '3', 'pid' => 1, 'name' => '二级栏目一'),
  => array('id' => '4', 'pid' => 1, 'name' => '二级栏目二'),
  => array('id' => '5', 'pid' => 2, 'name' => '二级栏目三'),
  => array('id' => '6', 'pid' => 3, 'name' => '三级栏目一'),
  => array('id' => '7', 'pid' => 3, 'name' => '三级栏目二')
  );

  $tree = new tree($arr);
  $rst = $tree->get_list();

  Header("Content-Type:text/html;charset=utf-8");
  echo '<pre>';
  print_r($rst);
 *
 */

class Tree {

    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    var $arr = array();

    /**
     * 生成树型结构所需修饰符号，可以换成图片
     * @var array
     */
    var $icon = array('│', '├', '└');

    /**
     * 默认样式
     * @var string
     */
    var $style = "<option value='\$id' selected='\$selected'>\$spacer\$name</option>";

    /**
     * 生成的书型结构字符串
     * @access private
     */
    var $ret = '';

    /**
     * 生成列表
     * @access private
     */
    var $list = array();

    /**
     * 构造函数，初始化类
     * @param array 2维数组，例如：
     * array(
     *      1 => array('id'=>'1','pid'=>0,'name'=>'一级栏目一'),
     *      2 => array('id'=>'2','pid'=>0,'name'=>'一级栏目二'),
     *      3 => array('id'=>'3','pid'=>1,'name'=>'二级栏目一'),
     *      4 => array('id'=>'4','pid'=>1,'name'=>'二级栏目二'),
     *      5 => array('id'=>'5','pid'=>2,'name'=>'二级栏目三'),
     *      6 => array('id'=>'6','pid'=>3,'name'=>'三级栏目一'),
     *      7 => array('id'=>'7','pid'=>3,'name'=>'三级栏目二')
     *      )
     */
    public function __construct($arr = array()) {
        $this->arr = $arr;
        $this->ret = '';
        $this->list = array();
        return is_array($arr);
    }

    /**
     * 获取父类
     * @param int $cid 子元素id
     * @return array 父类数组
     */
    public function get_parent($cid) {
        $arr = array();
        if (!isset($this->arr[$cid]))
            return FALSE;
        $pid = $this->arr[$cid]['pid'];
        foreach ($this->arr as $v) {
            if ($v['id'] == $pid) {
                $arr = $v;
            }
        }
        return $arr;
    }

    /**
     * 获取所有父类（与父类同级)
     * @param int $cid 子元素id
     * @return array 父类数组（二维数组）
     */
    public function get_parents($cid) {
        $arr = array();
        if (!isset($this->arr[$cid]))
            return FALSE;
        $pid_c = $this->arr[$cid]['pid'];
        $pid = $this->arr[$pid_c]['pid'];
        foreach ($this->arr as $v) {
            if ($v['id'] == $pid) {
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 获取子类
     * @param int $name 父id
     * @return unkonow 
     */
    public function get_child($pid = 0) {
        $arr = array();
        if (!is_array($this->arr))
            return FALSE;
        foreach ($this->arr as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v;
            }
        }
        return $arr ? $arr : FALSE;
    }

    /**
     * -------------------------------------
     *  得到树型结构
     * -------------------------------------
     * @param $pid 表示获得这个ID下的所有子级
     * @param $str 生成树形结构基本代码, 例如: "<option value='\$id' select='\$select'>\$spacer\$name</option>"
     * @param $sid 被选中的ID, 比如在做树形下拉框的时候需要用到
     * @param $adds  前缀
     * @return unknown_type
     */
    public function get_tree($pid = 0, $str = FALSE, $sid = 0, $adds = '') {
        if ($str === FALSE)
            $str = $this->style;
        $number = 1;
        $child = $this->get_child($pid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $a) {
                $j = $k = '';
                if ($number == $total) {
                    $j .= $this->icon[2];
                } else {
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $spacer = $adds ? $adds . $j : '';
                $selected = $id == $sid ? 'selected' : '';
                @extract($a);
                eval("\$nstr = \"$str\";");
                $this->ret .= $nstr;
                $this->get_tree($id, $str, $sid, $adds . $k . '&nbsp;');
                $number++;
            }
        }
        return $this->ret;
    }

    /**
     * 生成数组
     * @param int $pid 根id
     * return array
     */
    public function get_array($pid = 0) {
        $arr = array();
        foreach ($this->arr as $k => $v) {
            if ($v['pid'] == $pid) {
                $arr[$k] = $v;
                $arr[$k]['child'] = $this->get_array($v['id']);
            }
        }
        return $arr;
    }

    /**
     * 生成列表
     * @param int $pid 根id
     * @param string $cont 生成语句 "\$name"
     * @param string $prefix 前缀  <li>
     * @param string $suffix 后缀  </li>
     * @param string $prefix_p 前缀  <ul>
     * @param string $suffix_P 后缀  </ul>
     * @return array 
     */
    public function get_list($pid = 0, $cont = "\$name", $prefix = '<li>', $suffix = '</li>', $prefix_p = '<ul>', $suffix_p = '</ul>') {
        $str = '';
        $str.= $prefix_p;

        $arr = $this->get_child($pid);
        if ($arr !== FALSE) {
            foreach ($arr as $v) {
                $str.= $prefix;
                @extract($v);
                eval("\$ncont = \"$cont\";");
                $str.= $ncont;
                $str.= $this->get_list($v['id'], $cont, $prefix, $suffix);
                $str.= $suffix;
            }
        }

        $str.= $suffix_p;
        return $str;
    }

}

/* End of file myTree.php */
/* Location: ./myTree.php */
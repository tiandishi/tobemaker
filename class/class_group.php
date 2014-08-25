<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";

 class class_group
{
    private $db = null;
    public $num_of_waiting;

    function class_group(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }

    // ---------  增删改查基本操作 - 开始
    public function select($sql_select){
        $result = $this->db->get_results($sql_select, ARRAY_A);  
        if(count($result)>0) 
        {return $result;
        }
        else{
          return false;
        }
    }
   

   // 在表中增加数据  输入表名和数组字段

    public function insert($table_name,$array){
        $num=count($array);
        $keys=array_keys($array);
        $values=array_values($array);
        $aa=null;
        $bb=null;
        $i=0;
        while ($i<$num) {
                        # code...
                 $aa=$aa."`".$keys[$i]."`,";
                 $bb=$bb."'".$values[$i]."',";
                          $i=$i+1;         
        }
        $aa=rtrim($aa,",");
        $bb=rtrim($bb,",");
        $sql="insert into ".$table_name."(".$aa.") values(".$bb.")";
        $sql;
        $this->db->query($sql);
        $res=$this->db->get_results("SELECT LAST_INSERT_ID()",ARRAY_A);
        return $res[0]['LAST_INSERT_ID()'];
        //return $result;
    }
    
    // 更新表中某个字段
    private function update_one($table_name,$col_name,$value){
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    //删除某个id的群组
    public function delete_group($group_id){
	$sql='delete from `group` where `group_id`='.$group_id;
	$this->db->query($sql);
    }
	 //获取全部群组
    public function get_all_group()
	{
	$sql='select * from `group` ';
	$result = $this->db->get_results($sql,ARRAY_A);
	return $result;
	}
   
   //通过group字段更新数据  传入修改的id和字段=》值 数组实现更新 
   
     public function update_group($group_id,$arr)
    {
      $keys=array_keys($arr);
      $values=array_values($arr);
      $num_a=count($keys);
      $i=0;
      $aa="";
      $bb="";
      while ($i<$num_a) {
        # code...
        if($arr[$keys[$i]]!=""){
        $aa=$aa."`".$keys[$i]."`='".$values[$i]."',";
      }
        $i++;
      }
      $aa=rtrim($aa,",");
      $sql="UPDATE group SET ".$aa." where group_id=".$group_id;
	  
      $this->db->query($sql);
	  
     // echo $sql;
    }
	
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
//---------------所有idea操作

    
   
	 //获取部分群组
	 public function get_part_group($begin,$num)
	 {
	 $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT  `group`.* from `group` where 1 limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
	 }
   
    //验证是否重复
    public function check_is_unique($table_name,$arr_columns_value)
	{
	   $strsql='select * from `'.$table_name.'` ';
	    if (count($arr_columns_value)<=0)
	    {
	        return false;
	    }
	    else
	        {
			    $strsql=$strsql.'where ';
				$keys=array_keys($arr);
			    for($i=0;$i<count($arr_columns_value);$i++)
				{
				    if($i==0)
					{
					    $strsql=$strsql.'`'.$keys[$i].'`='.$arr_columns_value[$keys[$i]].' ';
					}
					else
					{
					     $strsql=$strsql.' and `'.$keys[$i].'`='.$arr_columns_value[$keys[$i]].' ';
					}
				}
	        }
		$result=$this->db->get_results($sql,ARRAY_A);
		return count($result);
	}
   

   
     

    //
}
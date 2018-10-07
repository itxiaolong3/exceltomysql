<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $this->display();
    }

    //导入
    public function eximport(){
    	$upload = new \Think\Upload();
    	$upload->maxSize   =     3145728 ;    
    	$upload->exts      =     array('xls', 'csv', 'xlsx');  
    	$upload->rootPath  =      './Public';    
    	$upload->savePath  =      '/excel/';    
    	$info   =   $upload->upload();
    	if(!$info){
    		$this->error($upload->getError());
    	}else{
    		$filename='./Public/'.$info['excel']['savepath'].$info['excel']['savename'];
    		import("Org.Yufan.ExcelReader");
    		$ExcelReader=new \ExcelReader();
    		$arr=$ExcelReader->reader_excel($filename);
            foreach ($arr as $key => $value) {
    			$data['username']=$arr[$key]['1'];
    			$data['money']=$arr[$key]['2'];
    			if(strstr($arr[$key]['3'],'-')){
                    $data['time']=strtotime($arr[$key]['3']);
                }else{
                    $t = $arr[$key]['3'];//读取到的值
                    $n = intval(($t - 25569) * 3600 * 24);//转换成1970年以来的秒数
                    $d= gmdate('Y-m-d H:i:s',$n);//格式化时间,不是用date哦, 时区相差8小时的
                    $data['time']=strtotime($d);
                }


    			M('dc')->add($data);

    		}
    		$this->success('导入成功');
    	}
    }

    //导出
    public function export(){
    	import("ORG.Yufan.Excel");
    	$list = M('dc')->select();
    	$row=array();
    	//$row[0]=array('用户id','用户名','金额','时间');
    	$i=0;
    	foreach($list as $v){
    	       // $row[$i]['i'] = $i;
    	        $row[$i]['uid'] = $v['id'];
    	        $row[$i]['username'] = $v['username'];
    	        $row[$i]['money'] = $v['money'];
    	        $row[$i]['time'] = date("Y-m-d H:i:s",$v['time']);
    	        $i++;
    	}
        $Header = array('用户id','用户名','金额','时间');
        $FileName = '数据报表(截止时间:'.date('YmdHis',time()).')';
        $this ->exportExcel($Header, $row, $FileName,  './', false);
//    	$xls = new \Excel_XML('UTF-8', false, 'Sheet1');
//    	$xls->addArray($row);
//    	$xls->generateXML("ceshi");
    }
    /**
     * 数据导出方法
     * @param array $title   标题行名称
     * @param array $data   导出数据
     * @param string $fileName 文件名
     * @param string $savePath 保存路径
     * @param $type   是否下载  false--保存   true--下载
     * @return string   返回文件全路径
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){
        Vendor("PHPExcel.PHPExcel");
        $obj = new \PHPExcel();

        //横向单元格标识
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称
        $_row = 1;   //设置纵向单元格标识
        if($title){
            $i = 0;
            foreach($title AS $v){   //设置列标题
                $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);
                $i++;
            }
            $_row++;
        }

        //填写数据
        if($data){
            $i = 0;
            foreach($data AS $_v){
                $j = 0;
                foreach($_v AS $_cell){
                    $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);
                    $j++;
                }
                $i++;
            }
        }

        //文件名处理
        if(!$fileName){
            $fileName = uniqid(time(),true);
        }
        $objWrite = \PHPExcel_IOFactory::createWriter($obj, 'Excel2007');

        if($isDown){   //网页下载
            header('pragma:public');
            header("Content-Disposition:attachment;filename=$fileName.xls");
            $objWrite->save('php://output');exit;
        }

        $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码
        header('pragma:public');
        header("Content-Disposition:attachment;filename=$_fileName.xlsx");
        $objWrite->save('php://output');exit;

        return $savePath.$fileName.'.xlsx';
    }


}
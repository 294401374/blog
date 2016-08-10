<?php
      // 1|开启,0|关闭
                   
                    $arr = explode(',',$v->field_value);
                    $str='';
                    foreach ($arr as $n => $m) {
                        $a = explode('|',$m);
                        $c = $v->conf_content==$a[0]?' checked ':'';
                        $str .='<input type="radio" name="conf_content[]" value="'.$a[0].'" '.$c.'/>'.$a[1];
                    }
                    $arr = explode(',',$v->field_value);
                    $str = '';
                    foreach($arr as $m=>$n){
                        //1|开启
                        $r = explode('|',$n);
                        $c = $v->conf_content==$r[0]?' checked ':'';
                        $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                    }
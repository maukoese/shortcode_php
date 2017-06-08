<?php

class SHORTCODE {

        public function do_short($str_short) {

                $regex="/^\[\/?[a-z_]*=?[a-z0-9,]*\]$/";

                preg_match($regex, $str_short, $data);

                $ret="";
                $new_str=str_replace("]","",$data[0]);
                $pass=0;

                if (strpos($new_str,"=")>0 ) {
 
                        $pass=1;
                        $param=explode("=", $new_str);

                        if (count($param)>0) {

                                $values=explode(",,", $param[1]);
                                $end=strpos($new_str,"=");
                                $sub_str=substr($new_str,0,$end);

                                if (substr($sub_str,0,2)=="[/") {

                                        $ret=self::closed_obj_par($sub_str, $values);

                                } else {
                                        
                                        $ret=self::open_obj_par($sub_str, $values);

                                }

                                return $ret;

                        } else {

                                return false;

                        }

                }
                
                if ($pass==0) {

                        if (substr($new_str,0,2)=="[/") {

                                $ret=self::closed_object($new_str);

                        } else if (substr($new_str,0,1)=="[") {

                                $ret=self::open_object($new_str);

                        }

                        return $ret;

                }

        }

        public function open_object($str_method) {

                $ret="";
                $method=substr($str_method, 1);

                if (method_exists(__CLASS__, $method)) {

                        $ret=call_user_func("self::".$method);

                } else {

                        $ret=false;

                }

                return $ret;
        }
    
    
        public function open_obj_par($str_method, $arr_param) {

                $ret="";
                $method=substr($str_method, 1);

                if (method_exists(__CLASS__, $method)) {

                        $ret=call_user_func_array("self::".$method, $arr_param);

                } else {

                        $ret=false;

                }

                return $ret;
                
        }
        
        public function closed_object($str_method) {

                $ret="";
                $method=substr($str_method, 2);

                if (method_exists(__CLASS__, $method)) {

                        $ret=call_user_func("self::".$method, 1);

                } else {

                        $ret=false;

                }

                return $ret;

        } 

        public function closed_obj_par($str_method, $arr_param) {

                $ret="";
                $method=substr($str_method, 2);

                $arr_param[]=1;

                if (method_exists(__CLASS__, $method)) {

                        $ret=call_user_func_array("self::".$method, $arr_param);

                } else {

                        $ret=false;

                }

                return $ret;
        }

        //
        // Testing Classes
        //

        public function test() {

                return "test";

        }

        public function param($par) {

                return "param >".$par."< ";

        }
       
        public function two_par($paro, $part) {

                return "two par >".$paro."<,#".$part."#";

        }

}

?>

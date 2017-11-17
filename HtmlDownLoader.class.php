<?php
    class DownLoader
    {
        public static function login_post($url,$cookie,$post)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_AUTOREFERER,true);
            curl_setopt($ch, CURLOPT_HEADER,1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); 
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));  //post提交数据
            $result=curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        public static function get_contents($url,$cookie)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); 
            $result=curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        
    }
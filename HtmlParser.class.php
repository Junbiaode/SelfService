<?php
    require_once 'html-parser/vendor/autoload.php';
    class Parser
    {
        private static $html_dom;
        public static function parse($html)
        {
           echo '<pre>';
           $info=array();
           $html=self::prepare($html);
           $finder=self::$html_dom->find('.d2220');
           $info['user_number']=trim($finder[0]->node->nodeValue,'【,】');
           $info['online_computer']=trim($finder[1]->node->nodeValue,'【,】');
           if($info['online_computer']==1)
           {
               $hander=self::$html_dom->find('.f3f6f');
               $info['ip_str']=$hander[2]->node->nodeValue;
               $info['ip_start_time']=$hander[3]->node->nodeValue;
           }
           $hander=self::$html_dom->find('span[id]');
           $info['user_state']=$hander[0]->node->textContent;
           $info['policydesc']=$hander[1]->node->textContent;
           $info['userperiod']=$hander[2]->node->textContent;
           $info['currentaccountfee']=$hander[3]->node->textContent;
           $info['currentpreparefee']=$hander[4]->node->textContent;
           print_r($info);
        }
        private static function prepare($html)
        {
            $html=mb_convert_encoding($html, "UTF-8", "GBK"); 
            //哈哈哈操你妈这样真的行              
            $html='<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>'.$html;
            self::$html_dom = new \HtmlParser\ParserDom($html);           
            return $html;
        }
    
    }
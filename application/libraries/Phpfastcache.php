<?php
/* Revision 620
 * ALl EXAMPLE & DOCUMENT ARE ON www.phpFastCache.com
 * IF YOU FOUND A BUG, PLEASE GO THERE: http://www.codehelper.io <-- Post your issues and I will fix it.
 * Open new issue and I will fix it for you in 24 hours
 * I stopped support issues on GitHub
 */

class CI_Phpfastcache {
    // Public OPTIONS
    // Can be set by phpFastCache::$option_name = $value|array|string
    public static $storage = "auto"; // PDO | mpdo | Auto | Files | memcache | apc | wincache | xcache
    public static $files_cleanup_after = 1; // hour | auto clean up files after this
    public static $autosize = 40; // Megabytes
    public static $path = "cache/phpfastcache"; // PATH/TO/CACHE/ default will be current path
    public static $securityKey = "cache.storage"; // phpFastCache::$securityKey = "newKey";
    public static $securityHtAccess = true; // auto create .htaccess
    public static $option = array();
    public static $server = array(array("localhost",11211)); // for MemCache
    public static $useTmpCache = false; // use for get from Tmp Memory, will be faster in checking cache on LOOP.
    public static $debugging = false; // turn true for debugging


    // NOTHING TO CHANGE FROM HERE
    private static $step_debugging = 0;
    private static $Tmp = array();
    private static $supported_api = array("pdo","mpdo","files","memcache","memcached","apc","xcache","wincache");
    private static $filename = "pdo.caching";
    private static $table = "objects";
    private static $autodb = "";
    private static $multiPDO = array();


    public static $sys = array();
    private static $checked = array(
        "path"  =>  false,
        "servers"   =>  array(),
        "config_file"   => "",
    );
    private static $objects = array(
        "memcache"  =>  "",
        "memcached" =>  "",
        "pdo"       =>  "",
    );


    private static function getOS() {
        $os = array(
            "os" => PHP_OS,
            "php" => PHP_SAPI,
            "system"    => php_uname(),
            "unique"    => md5(php_uname().PHP_OS.PHP_SAPI)
        );
        return $os;
    }



    public static function systemInfo() {
        // $this->startDebug($this->$sys,"Check Sys",__LINE__,__FUNCTION__);

        if(count($this->$sys) == 0 ) {

            // $this->startDebug("Start System Info");

            $this->$sys['os'] = $this->getOS();

            $this->$sys['errors'] = array();
            $this->$sys['storage'] = "";
            $this->$sys['method'] = "pdo";
            $this->$sys['drivers'] = array(
                "apc"   =>  false,
                "xcache"    => false,
                "memcache"  => false,
                "memcached"  => false,
                "wincache"  => false,
                "pdo"       => false,
                "mpdo"     => false,
                "files"     => false,

            );



            // Check apc
            if(extension_loaded('apc') && ini_get('apc.enabled'))
            {
                $this->$sys['drivers']['apc']   = true;
                $this->$sys['storage'] = "memory";
                $this->$sys['method'] = "apc";
            }

            // Check xcache
            if(extension_loaded('xcache') && function_exists("xcache_get"))
            {
                $this->$sys['drivers']['xcache']   = true;
                $this->$sys['storage'] = "memory";
                $this->$sys['method'] = "xcache";
            }

            if(extension_loaded('wincache') && function_exists("wincache_ucache_set"))
            {
                $this->$sys['drivers']['wincache']   = true;
                $this->$sys['storage'] = "memory";
                $this->$sys['method'] = "wincache";
            }

            // Check memcache
            if(function_exists("memcache_connect")) {
                $this->$sys['drivers']['memcache'] = true;

                try {
                    memcache_connect("127.0.0.1");
                    $this->$sys['storage'] = "memory";
                    $this->$sys['method'] = "memcache";
                } catch (Exception $e) {

                }
            }


            // Check memcached
            if(class_exists("memcached")) {
                $this->$sys['drivers']['memcached'] = true;

                try {
                    $memcached = new memcached();
                    $memcached->addServer("127.0.0.1","11211");
                    $this->$sys['storage'] = "memory";
                    $this->$sys['method'] = "memcached";

                } catch (Exception $e) {

                }
            }

            if(extension_loaded('pdo_sqlite')) {
                $this->$sys['drivers']['pdo']   = true;
                $this->$sys['drivers']['mpdo']   = true;
            }

            if(is_writable($this->getPath(true))) {
                $this->$sys['drivers']['files'] = true;
            }

            if($this->$sys['storage'] == "") {

                if(extension_loaded('pdo_sqlite')) {
                    $this->$sys['storage'] = "disk";
                    $this->$sys['method'] = "pdo";

                } else {

                    $this->$sys['storage'] = "disk";
                    $this->$sys['method'] = "files";

                }

            }



            if($this->$sys['storage'] == "disk" && !is_writable($this->getPath())) {
                $this->$sys['errors'][] = "Please Create & CHMOD 0777 or any Writeable Mode for ".$this->getPath();
            }




        }

        // $this->startDebug($this->$sys);
        return $this->$sys;
    }

    // return Folder Cache PATH
    // PATH Edit by SecurityKey
    // Auto create, Chmod and Warning

    // Revision 618
    // PHP_SAPI =  apache2handler should go to tmp
    private static function isPHPModule() {
        if(PHP_SAPI == "apache2handler") {
            return true;
        } else {
            if(strpos(PHP_SAPI,"handler") !== false) {
                return true;
            }
        }
        return false;
    }
    // Revision 618
    // Security with .htaccess
    static function htaccessGen($path = "") {
        if($this->$securityHtAccess == true) {

            if(!file_exists($path."/.htaccess")) {
             //   echo "write me";
                $html = "order deny, allow \r\n
deny from all \r\n
allow from 127.0.0.1";
                $f = @fopen($path."/.htaccess","w+");
                @fwrite($f,$html);
                @fclose($f);
            } else {
             //   echo "got me";
            }
        }

    }

    private static function getPath($skip_create = false) {

        if ($this->$path=='')
        {
            // revision 618
            if($this->isPHPModule()) {
                $tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
                $this->$path = $tmp_dir;
            } else {
                $this->$path = dirname(__FILE__);
            }

        }

        if($skip_create == false && $this->$checked['path'] == false) {
            if(!file_exists($this->$path."/".$this->$securityKey."/") || !is_writable($this->$path."/".$this->$securityKey."/")) {
                if(!file_exists($this->$path."/".$this->$securityKey."/")) {
                    @mkdir($this->$path."/".$this->$securityKey."/",0777);
                }
                if(!is_writable($this->$path."/".$this->$securityKey."/")) {
                    @chmod($this->$path."/".$this->$securityKey."/",0777);
                }
                if(!file_exists($this->$path."/".$this->$securityKey."/") || !is_writable($this->$path."/".$this->$securityKey."/")) {
                    die("Sorry, Please create ".$this->$path."/".$this->$securityKey."/ and SET Mode 0777 or any Writable Permission!" );
                }

            }

            $this->$checked['path'] = true;
            // Revision 618
            $this->htaccessGen($this->$path."/".$this->$securityKey."/");

        }



        return $this->$path."/".$this->$securityKey."/";


    }

    // return method automatic;
    // APC will be TOP, then Memcached, Memcache, PDO and Files
    public static function autoconfig($name = "") {
        // $this->startDebug($name,"Check Name",__LINE__,__FUNCTION__);

        $cache = $this->cacheMethod($name);
        if($cache != "" && $cache != $this->$storage && $cache!="auto") {
            return $cache;
        }

        // $this->startDebug($cache,"Check Cache",__LINE__,__FUNCTION__);

        $os = $this->getOS();
        // $this->startDebug($this->$storage,"User Set",__LINE__,__FUNCTION__);
        if($this->$storage == "" || $this->$storage == "auto") {
            // $this->startDebug($this->$storage,"User Set Auto",__LINE__,__FUNCTION__);

            if(extension_loaded('apc') && ini_get('apc.enabled') && strpos(PHP_SAPI,"CGI") === false)
            {

                $this->$sys['drivers']['apc']   = true;
                $this->$sys['storage'] = "memory";
                $this->$sys['method'] = "apc";

                // $this->startDebug($this->$sys,"GOT APC",__LINE__,__FUNCTION__);

            }elseif(extension_loaded('xcache'))
            {
                $this->$sys['drivers']['xcache']   = true;
                $this->$sys['storage'] = "memory";
                $this->$sys['method'] = "xcache";
                // $this->startDebug($this->$sys,"GOT XCACHE",__LINE__,__FUNCTION__);

            } else {
                // fix PATH for existing
                $reconfig = false;
                // $this->startDebug($this->getPath()."/config.".$os['unique'].".cache.ini","CHECK CONFIG FILE",__LINE__,__FUNCTION__);


                if (file_exists($this->getPath()."/config.".$os['unique'].".cache.ini"))
                {
                    $info = $this->decode(file_get_contents($this->getPath()."/config.".$os['unique'].".cache.ini"));

                    // $this->startDebug($info,"CHECK INFO",__LINE__,__FUNCTION__);

                    if(!isset($info['value'])) {
                        $reconfig = true;

                    } else {
                        $info = $info['value'];
                        $this->$sys = $info;

                    }


                } else {

                    $info = $this->systemInfo();
                    // $this->startDebug($info,"CHECK INFO BY SYSTEM INFO",__LINE__,__FUNCTION__);
                }

                if(isset($info['os']['unique'])) {

                    if($info['os']['unique'] != $os['unique']) {
                        $reconfig = true;
                    }
                } else {
                    $reconfig = true;
                }

                if(!file_exists($this->getPath()."/config.".$os['unique'].".cache.ini") || $reconfig == true) {

                    $info = $this->systemInfo();
                    $this->$sys = $info;
                    // $this->startDebug($info,"Check Info",__LINE__,__FUNCTION__);

                    try {
                        $f = fopen($this->getPath()."/config.".$os['unique'].".cache.ini","w+");
                        fwrite($f,$this->encode($info));
                        fclose($f);

                    } catch (Exception $e) {
                        die("Please chmod 0777 ".$this->getPath()."/config.".$os['unique'].".cache.ini");
                    }
                } else {

                }

            }



            $this->$storage = $this->$sys['method'];


        } else {

            if(in_array($this->$storage,array("files","pdo","mpdo"))) {
                $this->$sys['storage'] = "disk";
            }elseif(in_array($this->$storage,array("apc","memcache","memcached","wincache","xcache"))) {
                $this->$sys['storage'] = "memory";
            } else {
                $this->$sys['storage'] = "";
            }

            if($this->$sys['storage'] == "" || !in_array($this->$storage,$this->$supported_api)) {
                die("Don't have this Cache ".$this->$storage." In your System! Please double check!");
            }

            $this->$sys['method'] = strtolower($this->$storage);

        }

        if($this->$sys['method'] == "files") {
            $last_cleanup = $this->files_get("last_cleanup_cache");
            if($last_cleanup == null) {
                $this->files_cleanup();
                $this->files_set("last_cleanup_cache",@date("U"),3600*$this->$files_cleanup_after);
            }
        }

        // $this->startDebug($this->$sys,"Check RETURN SYS",__LINE__,__FUNCTION__);

        return $this->$sys['method'];

    }



    private static function cacheMethod($name = "") {
        $cache = $this->$storage;
        if(is_array($name)) {
            $key = array_keys($name);
            $key = $key[0];
            if(in_array($key,$this->$supported_api)) {
                $cache = $key;
            }
        }
        return $cache;
    }


    public static function safename($name) {
        return strtolower(preg_replace("/[^a-zA-Z0-9_\s\.]+/","",$name));
    }





    private static function encode($value,$time_in_second = "") {
        $value = serialize(array(
            "time"  => @date("U"),
            "value" => $value,
            "endin" => $time_in_second
        ));
        return $value;
    }

    private static function decode($value) {
        $x = @unserialize($value);
        if($x == false) {
            return $value;
        } else {
            return $x;
        }
    }

    /*
     * Start Public Static
     */

    public static function cleanup($option = "") {
        $api = $this->autoconfig();
        $this->$Tmp = array();

        switch ($api) {
            case "pdo":
                return $this->pdo_cleanup($option);
                break;
            case "mpdo":
                return $this->pdo_cleanup($option);
                break;
            case "files":
                return $this->files_cleanup($option);
                break;
            case "memcache":
                return $this->memcache_cleanup($option);
                break;
            case "memcached":
                return $this->memcached_cleanup($option);
                break;
            case "wincache":
                return $this->wincache_cleanup($option);
                break;
            case "apc":
                return $this->apc_cleanup($option);
                break;
            case "xcache":
                return $this->xcache_cleanup($option);
                break;
            default:
                return $this->pdo_cleanup($option);
                break;
        }

    }

    public static function delete($name = "string|array(db->item)") {

        $api = $this->autoconfig($name);
        if($this->$useTmpCache == true) {
            $tmp_name = md5(serialize($api.$name));
            if(isset($this->$Tmp[$tmp_name])) {
                unset($this->$Tmp[$tmp_name]);
            }
        }

        switch ($api) {
            case "pdo":
                return $this->pdo_delete($name);
                break;
            case "mpdo":
                return $this->pdo_delete($name);
                break;
            case "files":
                return $this->files_delete($name);
                break;
            case "memcache":
                return $this->memcache_delete($name);
                break;
            case "memcached":
                return $this->memcached_delete($name);
                break;
            case "wincache":
                return $this->wincache_delete($name);
                break;
            case "apc":
                return $this->apc_delete($name);
                break;
            case "xcache":
                return $this->xcache_delete($name);
                break;
            default:
                return $this->pdo_delete($name);
                break;
        }

    }


    public static function exists($name = "string|array(db->item)") {

        $api = $this->autoconfig($name);
        switch ($api) {
            case "pdo":
                return $this->pdo_exist($name);
                break;
            case "mpdo":
                return $this->pdo_exist($name);
                break;
            case "files":
                return $this->files_exist($name);
                break;
            case "memcache":
                return $this->memcache_exist($name);
                break;
            case "memcached":
                return $this->memcached_exist($name);
                break;
            case "wincache":
                return $this->wincache_exist($name);
                break;
            case "apc":
                return $this->apc_exist($name);
                break;
            case "xcache":
                return $this->xcache_exist($name);
                break;
            default:
                return $this->pdo_exist($name);
                break;
        }

    }

    public static function deleteMulti($object = array()) {
        $res = array();
        foreach($object as $driver=>$name)  {
            if(!is_numeric($driver)) {
                $n = $driver."_".$name;
                $name = array($driver=>$name);
            } else {
                $n = $name;
            }
            $res[$n] = $this->delete($name);
        }
        return $res;

    }

    public static function setMulti($mname = array(), $time_in_second_for_all = 600, $skip_for_all = false) {
        $res = array();

        foreach($mname as $object){
            //   print_r($object);

            $keys = array_keys($object);

            if($keys[0] != "0") {
                $k = $keys[0];
                $name = isset($object[$k]) ? array($k => $object[$k]) : "";
                $n = $k."_".$object[$k];
                $x=0;
            } else {
                $name = isset($object[0]) ? $object[0] : "";
                $x=1;
                $n = $name;
            }

            $value = isset($object[$x]) ? $object[$x] : "";$x++;
            $time = isset($object[$x]) ? $object[$x] : $time_in_second_for_all;$x++;
            $skip = isset($object[$x]) ? $object[$x] : $skip_for_all;$x++;

            if($name!="" && $value!="") {
                $res[$n] = $this->set($name,$value, $time, $skip);
            }
            // echo "<br> ----- <br>";

        }

        return $res;
    }



    public static function set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $api = $this->autoconfig($name);
        if($this->$useTmpCache == true) {
            $tmp_name = md5(serialize($api.$name));
            $this->$Tmp[$tmp_name] = $value;
        }

        switch ($api) {
            case "pdo":
                return $this->pdo_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "mpdo":
                return $this->pdo_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "files":
                return $this->files_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "memcache":
                return $this->memcache_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "memcached":
                return $this->memcached_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "wincache":
                return $this->wincache_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "apc":
                return $this->apc_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            case "xcache":
                return $this->xcache_set($name,$value,$time_in_second, $skip_if_existing);
                break;
            default:
                return $this->pdo_set($name,$value,$time_in_second, $skip_if_existing);
                break;
        }

    }






    public static function decrement($name, $step = 1) {
        $api = $this->autoconfig($name);
        if($this->$useTmpCache == true) {
            $tmp_name = md5(serialize($api.$name));
            if(isset($this->$Tmp[$tmp_name])) {
                $this->$Tmp[$tmp_name] = (Int)$this->$Tmp[$tmp_name] - $step;
            } else {
                $this->$Tmp[$tmp_name] = $step;
            }

        }
        switch ($api) {
            case "pdo":
                return $this->pdo_decrement($name, $step);
                break;
            case "mpdo":
                return $this->pdo_decrement($name, $step);
                break;
            case "files":
                return $this->files_decrement($name, $step);
                break;
            case "memcache":
                return $this->memcache_decrement($name, $step);
                break;
            case "memcached":
                return $this->memcached_decrement($name, $step);
                break;
            case "wincache":
                return $this->wincache_decrement($name, $step);
                break;
            case "apc":
                return $this->apc_decrement($name, $step);
                break;
            case "xcache":
                return $this->xcache_decrement($name, $step);
                break;
            default:
                return $this->pdo_decrement($name, $step);
                break;
        }
    }



    public static function get($name) {
        $api = $this->autoconfig($name);
        if($this->$useTmpCache == true) {
            $tmp_name = md5(serialize($api.$name));
            if(isset($this->$Tmp[$tmp_name])) {
                return $this->$Tmp[$tmp_name];
            }
        }

        // $this->startDebug($api,"API",__LINE__,__FUNCTION__);

        // for files, check it if NULL and "empty" string
        switch ($api) {
            case "pdo":
                return $this->pdo_get($name);
                break;
            case "mpdo":
                return $this->pdo_get($name);

                break;
            case "files":
                return  $this->files_get($name);
                break;
            case "memcache":
                return $this->memcache_get($name);
                break;
            case "memcached":
                return $this->memcached_get($name);
                break;
            case "wincache":
                return  $this->wincache_get($name);
                break;
            case "apc":
                return  $this->apc_get($name);
                break;
            case "xcache":
                return   $this->xcache_get($name);
                break;
            default:
                return  $this->pdo_get($name);
                break;
        }

    }


    public static function getMulti($object = array()) {
        $res = array();
        foreach($object as $driver=>$name)  {
            if(!is_numeric($driver)) {
                $n = $driver."_".$name;
                $name = array($driver=>$name);
            } else {
                $n = $name;
            }
            $res[$n] = $this->get($name);
        }
        return $res;

    }



    public static function stats() {
        $api = $this->autoconfig();
        switch ($api) {
            case "pdo":
                return $this->pdo_stats();
                break;
            case "mpdo":
                return $this->pdo_stats();
                break;
            case "files":
                return $this->files_stats();
                break;
            case "memcache":
                return $this->memcache_stats();
                break;
            case "memcached":
                return $this->memcached_stats();
                break;
            case "wincache":
                return $this->wincache_stats();
                break;
            case "apc":
                return $this->apc_stats();
                break;
            case "xcache":
                return $this->xcache_stats();
                break;
            default:
                return $this->pdo_stats();
                break;
        }
    }

    public static function increment($name, $step = 1) {
        $api = $this->autoconfig($name);

        if($this->$useTmpCache == true) {
            $tmp_name = md5(serialize($api.$name));
            if(isset($this->$Tmp[$tmp_name])) {
                $this->$Tmp[$tmp_name] = (Int)$this->$Tmp[$tmp_name] + $step;
            } else {
                $this->$Tmp[$tmp_name] = $step;
            }

        }

        switch ($api) {
            case "pdo":
                return $this->pdo_increment($name, $step);
                break;
            case "mpdo":
                return $this->pdo_increment($name, $step);
                break;
            case "files":
                return $this->files_increment($name, $step);
                break;
            case "memcache":
                return $this->memcache_increment($name, $step);
                break;
            case "memcached":
                return $this->memcached_increment($name, $step);
                break;
            case "wincache":
                return $this->wincache_increment($name, $step);
                break;
            case "apc":
                return $this->apc_increment($name, $step);
                break;
            case "xcache":
                return $this->xcache_increment($name, $step);
                break;
            default:
                return $this->pdo_increment($name, $step);
                break;
        }
    }


    /*
     * Begin FILES Cache Static
     * Use Files & Folders to cache
     */

    private static function files_exist($name) {
        $data = $this->files_get($name);
        if($data == null) {
            return false;
        } else {
            return true;
        }
    }



    private static function files_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {

        $db = $this->selectDB($name);
        $name = $db['item'];
        $folder = $db['db'];

        $path = $this->getPath();
        $tmp = explode("/",$folder);
        foreach($tmp as $dir) {
            if($dir!="" && $dir !="." && $dir!="..") {
                $path.="/".$dir;
                if(!file_exists($path)) {
                    mkdir($path,0777);
                }
            }
        }

        $file = $path."/".$name.".c.html";

        $write = true;
        if(file_exists($file)) {
            $data = $this->decode(file_get_contents($file));
            if($skip_if_existing == true && ((Int)$data['time'] + (Int)$data['endin'] > @date("U")) ) {
                $write = false;
            }
        }

        if($write == true ) {
            try {
                $f = fopen($file,"w+");
                fwrite($f,$this->encode($value,$time_in_second));
                fclose($f);
            } catch (Exception $e) {
                die("Sorry, can't write cache to file :".$file );
            }
        }

        return $value;
    }

    private static function files_get($name) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        $folder = $db['db'];

        $path = $this->getPath();
        $tmp = explode("/",$folder);
        foreach($tmp as $dir) {
            if($dir!="" && $dir !="." && $dir!="..") {
                $path.="/".$dir;
            }
        }

        $file = $path."/".$name.".c.html";

        if(!file_exists($file)) {
            return null;
        }

        $data = $this->decode(file_get_contents($file));

        if(!isset($data['time']) || !isset($data['endin']) || !isset($data['value'])) {
            return null;
        }

        if($data['time'] + $data['endin'] < @date("U")) {
            // exp
            unlink($file);
            return null;
        }

        return isset($data['value']) ? $data['value'] : null;
    }

    private static function files_stats($dir = "") {
        $total = array(
            "expired"   =>  0,
            "size"      =>  0,
            "files"     =>  0
        );
        if($dir == "") {
            $dir = $this->getPath();
        }
        $d = opendir($dir);
        while($file = readdir($d))
        {
            if($file!="." && $file != "..") {
                $path = $dir."/".$file;
                if(is_dir($path)) {
                    $in = $this->files_stats($path);
                    $total['expired'] = $total['expired'] + $in['expired'];
                    $total['size'] = $total['size'] + $in['size'];
                    $total['files'] = $total['files'] + $in['files'];
                }

                elseif(strpos($path,".c.html")!== false) {
                    $data = $this->decode($path);
                    if(isset($data['value']) && isset($data['time']) && isset($data['endin'])) {
                        $total['files']++;
                        if($data['time'] + $data['endin'] < @date("U")) {
                            $total['expired']++;
                        }
                        $total['size'] = $total['size'] + filesize($path);
                    }
                }
            }

        }
        if($total['size'] > 0) {
            $total['size'] = $total['size']/1024/1024;
        }
        return $total;
    }

    private static function files_cleanup($dir = "") {
        $total = 0;
        if($dir == "") {
            $dir = $this->getPath();
        }
        $d = opendir($dir);
        while($file = readdir($d))
        {
            if($file!="." && $file != "..") {
                $path = $dir."/".$file;
                if(is_dir($path)) {
                    $total = $total + $this->files_cleanup($path);
                    try {
                        @unlink($path);
                    } catch (Exception $e) {
                        // nothing;
                    }
                }
                elseif(strpos($path,".c.html")!==false) {
                    $data = $this->decode($path);
                    if(isset($data['value']) && isset($data['time']) && isset($data['endin'])) {
                        if((Int)$data['time'] + (Int)$data['endin'] < @date("U")) {
                            unlink($path);
                            $total++;
                        }
                    } else {
                        unlink($path);
                        $total++;
                    }
                }
            }

        }
        return $total;
    }

    private static function files_delete($name) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        $folder = $db['db'];

        $path = $this->getPath();
        $tmp = explode("/",$folder);
        foreach($tmp as $dir) {
            if($dir!="" && $dir !="." && $dir!="..") {
                $path.="/".$dir;
            }
        }

        $file = $path."/".$name.".c.html";
        if(file_exists($file)) {
            try {
                unlink($file);
                return true;
            } catch(Exception $e) {
                return false;
            }

        }
        return true;
    }

    private static function files_increment($name, $step = 1) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        $folder = $db['db'];

        $path = $this->getPath();
        $tmp = explode("/",$folder);
        foreach($tmp as $dir) {
            if($dir!="" && $dir !="." && $dir!="..") {
                $path.="/".$dir;
            }
        }

        $file = $path."/".$name.".c.html";
        if(!file_exists($file)) {
            $this->files_set($name,$step,3600);
            return $step;
        }

        $data = $this->decode(file_get_contents($file));
        if(isset($data['time']) && isset($data['value']) && isset($data['endin'])) {
            $data['value'] = $data['value'] + $step;
            $this->files_set($name,$data['value'],$data['endin']);
        }
        return $data['value'];
    }

    private static function files_decrement($name, $step = 1) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        $folder = $db['db'];

        $path = $this->getPath();
        $tmp = explode("/",$folder);
        foreach($tmp as $dir) {
            if($dir!="" && $dir !="." && $dir!="..") {
                $path.="/".$dir;
            }
        }

        $file = $path."/".$name.".c.html";
        if(!file_exists($file)) {
            $this->files_set($name,$step,3600);
            return $step;
        }

        $data = $this->decode(file_get_contents($file));
        if(isset($data['time']) && isset($data['value']) && isset($data['endin'])) {
            $data['value'] = $data['value'] - $step;
            $this->files_set($name,$data['value'],$data['endin']);
        }
        return $data['value'];
    }

    private static function getMemoryName($name) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        $folder = $db['db'];
        $name = $folder."_".$name;

        // connect memory server
        if($this->$sys['method'] == "memcache" || $db['db'] == "memcache") {
            $this->memcache_addserver();
        }elseif($this->$sys['method'] == "memcached" || $db['db'] == "memcached") {
            $this->memcached_addserver();
        }elseif($this->$sys['method'] == "wincache") {
            // init WinCache here

        }

        return $name;
    }


    /*
     * Begin XCache Static
     * http://xcache.lighttpd.net/wiki/XcacheApi
     */

    private static function xcache_exist($name) {
        $name = $this->getMemoryName($name);
        if(xcache_isset($name)) {
            return true;
        } else {
            return false;
        }
    }


    private static function xcache_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $name = $this->getMemoryName($name);
        if($skip_if_existing == true) {
            if(!$this->xcache_exist($name)) {
                return xcache_set($name,$value,$time_in_second);
            }
        } else {
            return xcache_set($name,$value,$time_in_second);
        }
        return false;
    }

    private static function xcache_get($name) {

        $name = $this->getMemoryName($name);

        $data = xcache_get($name);

        if($data === false || $data == "") {
            return null;
        }
        return $data;

    }

    private static function xcache_stats() {
        try {
            return xcache_list(XC_TYPE_VAR,100);
        } catch(Exception $e) {
            return array();
        }
    }

    private static function xcache_cleanup($option = array()) {
        // Revision 621

        $cnt = xcache_count(XC_TYPE_VAR);
        for ($i=0; $i < $cnt; $i++) {
            xcache_clear_cache(XC_TYPE_VAR, $i);
        }
        return true;
    }

    private static function xcache_delete($name) {
        $name = $this->getMemoryName($name);
        return xcache_unset($name);
    }

    private static function xcache_increment($name, $step = 1) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        $ret =xcache_inc($name, $step);
        if($ret === false) {
            $this->xcache_set($orgi,$step,3600);
            return $step;
        } else {
            return $ret;
        }
    }

    private static function xcache_decrement($name, $step = 1) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        $ret = xcache_dec($name, $step);
        if($ret === false) {
            $this->xcache_set($orgi,$step,3600);
            return $step;
        } else {
            return $ret;
        }
    }


    /*
     * Begin APC Static
     * http://www.php.net/manual/en/ref.apc.php
     */

    private static function apc_exist($name) {
        $name = $this->getMemoryName($name);
        if(apc_exists($name)) {
            return true;
        } else {
            return false;
        }
    }


    private static function apc_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $name = $this->getMemoryName($name);
        if($skip_if_existing == true) {
            return apc_add($name,$value,$time_in_second);
        } else {
            return apc_store($name,$value,$time_in_second);
        }
    }

    private static function apc_get($name) {

        $name = $this->getMemoryName($name);

        $data = apc_fetch($name,$bo);

        if($bo === false) {
            return null;
        }
        return $data;

    }

    private static function apc_stats() {
        try {
            return apc_cache_info("user");
        } catch(Exception $e) {
            return array();
        }
    }

    private static function apc_cleanup($option = array()) {
        return apc_clear_cache("user");
    }

    private static function apc_delete($name) {
        $name = $this->getMemoryName($name);
        return apc_delete($name);
    }

    private static function apc_increment($name, $step = 1) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        $ret = apc_inc($name, $step, $fail);
        if($ret === false) {
            $this->apc_set($orgi,$step,3600);
            return $step;
        } else {
            return $ret;
        }
    }

    private static function apc_decrement($name, $step = 1) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        $ret = apc_dec($name, $step, $fail);
        if($ret === false) {
            $this->apc_set($orgi,$step,3600);
            return $step;
        } else {
            return $ret;
        }
    }


    /*
     * Begin Memcache Static
     * http://www.php.net/manual/en/class.memcache.php
     */
    public static function memcache_addserver() {
        if(!isset($this->$checked['memcache'])) {
            $this->$checked['memcache'] = array();
        }

        if($this->$objects['memcache'] == "") {
            $this->$objects['memcache'] = new Memcache();

            foreach($this->$server as $server) {
                $name = isset($server[0]) ? $server[0] : "";
                $port = isset($server[1]) ? $server[1] : 11211;
                if(!in_array($server, $this->$checked['memcache']) && $name !="") {
                    $this->$objects['memcache']->addServer($name,$port);
                    $this->$checked['memcache'][] = $name;
                }
            }

        }

    }



    private static function memcache_exist($name) {
        $x = $this->memcache_get($name);
        if($x == null) {
            return false;
        } else {
            return true;
        }
    }






    private static function memcache_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        if($skip_if_existing == false) {
            return $this->$objects['memcache']->set($name, $value, false, $time_in_second );
        } else {
            return $this->$objects['memcache']->add($name, $value, false, $time_in_second );
        }

    }

    private static function memcache_get($name) {
        $name = $this->getMemoryName($name);
        $x = $this->$objects['memcache']->get($name);
        if($x == false) {
            return null;
        } else {
            return $x;
        }
    }

    private static function memcache_stats() {
        $this->memcache_addserver();
        return $this->$objects['memcache']->getStats();
    }

    private static function memcache_cleanup($option = "") {
        $this->memcache_addserver();
        $this->$objects['memcache']->flush();
        return true;
    }

    private static function memcache_delete($name) {
        $name = $this->getMemoryName($name);
        return $this->$objects['memcache']->delete($name);
    }

    private static function memcache_increment($name, $step = 1) {
        $name = $this->getMemoryName($name);
        return $this->$objects['memcache']->increment($name, $step);
    }

    private static function memcache_decrement($name, $step = 1) {
        $name = $this->getMemoryName($name);
        return $this->$objects['memcache']->decrement($name, $step);
    }



    /*
     * Begin Memcached Static
     */

    public static function memcached_addserver() {
        if(!isset($this->$checked['memcached'])) {
            $this->$checked['memcached'] = array();
        }

        if($this->$objects['memcached'] == "") {
            $this->$objects['memcached'] = new Memcached();

            foreach($this->$server as $server) {
                $name = isset($server[0]) ? $server[0] : "";
                $port = isset($server[1]) ? $server[1] : 11211;
                $sharing = isset($server[2]) ? $server[2] : 0;
                if(!in_array($server, $this->$checked['memcached']) && $name !="") {
                    if($sharing >0 ) {
                        $this->$objects['memcached']->addServer($name,$port,$sharing);
                    } else {
                        $this->$objects['memcached']->addServer($name,$port);
                    }

                    $this->$checked['memcached'][] = $name;
                }
            }

        }
    }


    private static function memcached_exist($name) {
        $x = $this->memcached_get($name);
        if($x == null) {
            return false;
        } else {
            return true;
        }
    }



    private static function memcached_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        if($skip_if_existing == false) {
            return $this->$objects['memcached']->set($name, $value, time() + $time_in_second );
        } else {
            return $this->$objects['memcached']->add($name, $value, time() + $time_in_second );
        }

    }

    private static function memcached_get($name) {
        $name = $this->getMemoryName($name);
        $x = $this->$objects['memcached']->get($name);
        if($x == false) {
            return null;
        } else {
            return $x;
        }
    }

    private static function memcached_stats() {
        $this->memcached_addserver();
        return $this->$objects['memcached']->getStats();
    }

    private static function memcached_cleanup($option = "") {
        $this->memcached_addserver();
        $this->$objects['memcached']->flush();
        return true;
    }

    private static function memcached_delete($name) {
        $name = $this->getMemoryName($name);
        return $this->$objects['memcached']->delete($name);
    }

    private static function memcached_increment($name, $step = 1) {
        $name = $this->getMemoryName($name);
        return $this->$objects['memcached']->increment($name, $step);
    }

    private static function memcached_decrement($name, $step = 1) {
        $name = $this->getMemoryName($name);
        return $this->$objects['memcached']->decrement($name, $step);
    }

    /*
     * Begin WinCache Static
     */

    private static function wincache_exist($name) {
        $name = $this->getMemoryName($name);
        if(wincache_ucache_exists($name)) {
            return true;
        } else {
            return false;
        }
    }




    private static function wincache_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $orgi = $name;
        $name = $this->getMemoryName($name);
        if($skip_if_existing == false) {
            return wincache_ucache_set($name, $value, $time_in_second );
        } else {
            return wincache_ucache_add($name, $value, $time_in_second );
        }

    }

    private static function wincache_get($name) {
        $name = $this->getMemoryName($name);

        $x = wincache_ucache_get($name,$suc);

        if($suc == false) {
            return null;
        } else {
            return $x;
        }
    }

    private static function wincache_stats() {
        return wincache_scache_info();
    }

    private static function wincache_cleanup($option = "") {
        wincache_ucache_clear();
        return true;
    }

    private static function wincache_delete($name) {
        $name = $this->getMemoryName($name);
        return wincache_ucache_delete($name);
    }

    private static function wincache_increment($name, $step = 1) {
        $name = $this->getMemoryName($name);
        return wincache_ucache_inc($name, $step);
    }

    private static function wincache_decrement($name, $step = 1) {
        $name = $this->getMemoryName($name);
        return wincache_ucache_dec($name, $step);
    }


    /*
     * Begin PDO Static
     */

    private static function pdo_exist($name) {
        $db = $this->selectDB($name);
        $name = $db['item'];

        $x = $this->db(array('db'=>$db['db']))->prepare("SELECT COUNT(*) as `total` FROM ".$this->$table." WHERE `name`=:name");

        $x->execute(array(
            ":name" => $name,
        ));

        $row = $x->fetch(PDO::FETCH_ASSOC);
        if($row['total'] >0 ){
            return true;
        } else {
            return false;
        }

    }


    private static function pdo_cleanup($option = "") {
        $this->db(array("skip_clean" => true))->exec("drop table if exists ".$this->$table);
        $this->initDatabase();
        return true;
    }

    private static function pdo_stats($full = false) {
        $res = array();
        if($full == true) {
            $stm = $this->db()->prepare("SELECT * FROM ".$this->$table."");
            $stm->execute();
            $result = $stm->fetchAll();
            $res['data'] = $result;
        }
        $stm = $this->db()->prepare("SELECT COUNT(*) as `total` FROM ".$this->$table."");
        $stm->execute();
        $result = $stm->fetch();
        $res['record'] = $result['total'];
        if($this->$path!="memory") {
            $res['size'] = filesize($this->getPath()."/".$this->$filename);
        }

        return $res;
    }


    // for PDO return DB name,
    // For Files, return Dir
    private static function selectDB($object) {
        $res = array(
            'db'    => "",
            'item'  => "",
        );
        if(is_array($object)) {
            $key = array_keys($object);
            $key = $key[0];
            $res['db'] = $key;
            $res['item'] = $this->safename($object[$key]);
        } else {
            $res['item'] = $this->safename($object);
        }

        if($res['db'] == "" && $this->$sys['method'] == "files") {
            $res['db'] = "files";
        }

        // for auto database
        if($res['db'] == "" && $this->$storage== "mpdo") {
            $create_table = false;
            if(!file_exists('sqlite:'.$this->getPath().'/phpfastcache.c')) {
                $create_table = true;
            }
            if($this->$autodb == "") {
                try {
                    $this->$autodb = new PDO('sqlite:'.$this->getPath().'/phpfastcache.c');
                    $this->$autodb->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

                } catch (PDOexception  $e) {
                    die("Please CHMOD 0777 or Writable Permission for ".$this->getPath());
                }

            }

            if($create_table == true) {
                $this->$autodb->exec('CREATE TABLE IF NOT EXISTS "main"."db" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , "item" VARCHAR NOT NULL  UNIQUE , "dbname" INTEGER NOT NULL )');
            }

            $db = $this->$autodb->prepare("SELECT * FROM `db` WHERE `item`=:item");
            $db->execute(array(
                ":item" => $res['item'],
            ));
            $row = $db->fetch(PDO::FETCH_ASSOC);
            if(isset($row['dbname'])) {
                // found key
                $res['db'] = $row['dbname'];
            } else {
                // not key // check filesize
                if((Int)$this->$autosize < 10) {
                    $this->$autosize = 10;
                }
                // get last key
                $db = $this->$autodb->prepare("SELECT * FROM `db` ORDER BY `id` DESC");
                $db->execute();
                $row = $db->fetch(PDO::FETCH_ASSOC);
                $dbname = isset($row['dbname']) ? $row['dbname'] : 1;
                $fsize = file_exists($this->getPath()."/".$dbname.".cache") ? filesize($this->getPath()."/".$dbname.".cache") : 0;
                if($fsize > (1024*1024*(Int)$this->$autosize)) {
                    $dbname = (Int)$dbname + 1;
                }
                try {
                    $insert = $this->$autodb->prepare("INSERT INTO `db` (`item`,`dbname`) VALUES(:item,:dbname)");
                    $insert->execute(array(
                        ":item" => $res['item'],
                        ":dbname"   => $dbname
                    ));
                } catch (PDOexception  $e) {
                    die('Database Error - Check A look at $this->$autodb->prepare("INSERT INTO ');
                }

                $res['db'] = $dbname;

            }
        }

        return $res;

    }

    private static function pdo_get($name) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        // array('db'=>$db['db'])

        // $this->startDebug($db,"",__LINE__,__FUNCTION__);

        $stm = $this->db(array('db'=>$db['db']))->prepare("SELECT * FROM ".$this->$table." WHERE `name`='".$name."'");
        $stm->execute();
        $res = $stm->fetch(PDO::FETCH_ASSOC);

        if(!isset($res['value'])) {
            return null;
        } elseif((Int)$res['added'] + (Int)$res['endin'] <= (Int)@date("U")) {
            return null;
        } else {
            // decode value on SQL;
            $data = $this->decode($res['value']);
            // check if VALUE on string encode
            return isset($data['value']) ? $data['value'] : null;
        }
    }

    private static function pdo_decrement($name, $step = 1) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        // array('db'=>$db['db'])

        $int = $this->get($name);
        try {
            $stm = $this->db(array('db'=>$db['db']))->prepare("UPDATE ".$this->$table." SET `value`=:new WHERE `name`=:name ");
            $stm->execute(array(
                ":new"  => $this->encode($int - $step),
                ":name" =>  $name,
            ));

        } catch (PDOexception  $e) {
            die("Sorry! phpFastCache don't allow this type of value - Name: ".$name." -> Decrement: ".$step);
        }
        return $int - $step;

    }

    private static function pdo_increment($name ,$step = 1) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        // array('db'=>$db['db'])

        $int = $this->get($name);
        // echo $int."xxx";
        try {
            $stm = $this->db(array('db'=>$db['db']))->prepare("UPDATE ".$this->$table." SET `value`=:new WHERE `name`=:name ");
            $stm->execute(array(
                ":new" => $this->encode($int + $step),
                ":name" =>  $name,
            ));

        } catch (PDOexception  $e) {
            die("Sorry! phpFastCache don't allow this type of value - Name: ".$name." -> Increment: ".$step);
        }
        return $int + $step;

    }

    private static function pdo_delete($name) {
        $db = $this->selectDB($name);
        $name = $db['item'];

        return $this->db(array('db'=>$db['db']))->exec("DELETE FROM ".$this->$table." WHERE `name`='".$name."'");
    }

    private static function pdo_set($name,$value,$time_in_second = 600, $skip_if_existing = false) {
        $db = $this->selectDB($name);
        $name = $db['item'];
        // array('db'=>$db['db'])

        if($skip_if_existing == true) {
            try {
                $insert = $this->db(array('db'=>$db['db']))->prepare("INSERT OR IGNORE INTO ".$this->$table." (name,value,added,endin) VALUES(:name,:value,:added,:endin)");
                try {
                    $value = $this->encode($value);
                } catch(Exception $e) {
                    die("Sorry! phpFastCache don't allow this type of value - Name: ".$name);
                }

                $insert->execute(array(
                    ":name"  => $name,
                    ":value"    => $value,
                    ":added"    => @date("U"),
                    ":endin"  =>  (Int)$time_in_second
                ));

                return true;
            } catch (PDOexception  $e) {
                return false;
            }

        } else {
            try {
                $insert = $this->db(array('db'=>$db['db']))->prepare("INSERT OR REPLACE INTO ".$this->$table." (name,value,added,endin) VALUES(:name,:value,:added,:endin)");
                try {
                    $value = $this->encode($value);
                } catch(Exception $e) {
                    die("Sorry! phpFastCache don't allow this type of value - Name: ".$name);
                }

                $insert->execute(array(
                    ":name"  => $name,
                    ":value"    => $value,
                    ":added"    => @date("U"),
                    ":endin"  =>  (Int)$time_in_second
                ));

                return true;
            } catch (PDOexception  $e) {
                return false;
            }
        }
    }



    private static function db($option = array()) {
        $vacuum = false;
        $dbname = isset($option['db']) ? $option['db'] : "";
        $dbname = $dbname != "" ? $dbname : $this->$filename;
        if($dbname!=$this->$filename) {
            $dbname = $dbname.".cache";
        }
        // debuging
        // $this->startDebug($this->$storage,"Check Storage",__LINE__,__FUNCTION__);
        $initDB = false;

        if($this->$storage == "pdo") {
            // start self PDO
            if($this->$objects['pdo']=="") {

                //  $this->$objects['pdo'] == new PDO("sqlite:".$this->$path."/cachedb.sqlite");
                if(!file_exists($this->getPath()."/".$dbname)) {
                    $initDB = true;
                } else {
                    if(!is_writable($this->getPath()."/".$dbname)) {
                        @chmod($this->getPath()."/".$dbname,0777);
                        if(!is_writable($this->getPath()."/".$dbname)) {
                            die("Please CHMOD 0777 or any Writable Permission for ".$this->getPath()."/".$dbname);
                        }
                    }
                }



                try {
                    $this->$objects['pdo'] = new PDO("sqlite:".$this->getPath()."/".$dbname);
                    $this->$objects['pdo']->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

                    if($initDB == true) {
                        $this->initDatabase();
                    }

                    $time = filemtime($this->getPath()."/".$dbname);
                    if($time + (3600*24) < @date("U")) {
                        $vacuum = true;
                    }

                    // Revision 619
                    // auto Vaccuum() every 48 hours
                    if($vacuum == true) {
                        if(!isset($option['skip_clean'])) {
                            $this->$objects['pdo']->exec("DELETE FROM ".$this->$table." WHERE (`added` + `endin`) < ".@date("U"));
                        }
                        $this->$objects['pdo']->exec('VACUUM');
                    }



                } catch (PDOexception  $e) {
                    die("Can't connect to caching file ".$this->getPath()."/".$dbname);
                }






                return $this->$objects['pdo'];

            } else {
                return $this->$objects['pdo'];
            }
            // end self pdo

        } elseif($this->$storage == "mpdo") {

            // start self PDO
            if(!isset($this->$multiPDO[$dbname])) {
                //  $this->$objects['pdo'] == new PDO("sqlite:".$this->$path."/cachedb.sqlite");
                if($this->$path!="memory") {
                    if(!file_exists($this->getPath()."/".$dbname)) {
                        $initDB = true;
                    } else {
                        if(!is_writable($this->getPath()."/".$dbname)) {
                            @chmod($this->getPath()."/".$dbname,0777);
                            if(!is_writable($this->getPath()."/".$dbname)) {
                                die("Please CHMOD 0777 or any Writable Permission for PATH ".$this->getPath());
                            }
                        }
                    }



                    try {
                        $this->$multiPDO[$dbname] = new PDO("sqlite:".$this->getPath()."/".$dbname);
                        $this->$multiPDO[$dbname]->setAttribute(PDO::ATTR_ERRMODE,
                            PDO::ERRMODE_EXCEPTION);

                        if($initDB == true) {
                            $this->initDatabase($this->$multiPDO[$dbname]);
                        }

                        $time = filemtime($this->getPath()."/".$dbname);
                        if($time + (3600*24) < @date("U")) {
                            $vacuum = true;
                        }

                        // Revision 619
                        if($vacuum == true) {
                            if(!isset($option['skip_clean'])) {
                                $this->$multiPDO[$dbname]->exec("DELETE FROM ".$this->$table." WHERE (`added` + `endin`) < ".@date("U"));
                            }
                            $this->$multiPDO[$dbname]->exec('VACUUM');
                        }

                    } catch (PDOexception  $e) {
                        // Revision 619
                       die("Can't connect to caching file ".$this->getPath()."/".$dbname);
                    }


                }




                return $this->$multiPDO[$dbname];

            } else {
                return $this->$multiPDO[$dbname];
            }
            // end self pdo

        }





    }

    private static function initDatabase($object = null) {
        if($object == null) {
            $this->db(array("skip_clean" => true))->exec('CREATE TABLE IF NOT EXISTS "'.$this->$table.'" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , "name" VARCHAR UNIQUE NOT NULL  , "value" BLOB, "added" INTEGER NOT NULL  DEFAULT 0, "endin" INTEGER NOT NULL  DEFAULT 0)');
            $this->db(array("skip_clean" => true))->exec('CREATE INDEX "lookup" ON "'.$this->$table.'" ("added" ASC, "endin" ASC)');
            $this->db(array("skip_clean" => true))->exec('VACUUM');
        } else {
            $object->exec('CREATE TABLE IF NOT EXISTS "'.$this->$table.'" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , "name" VARCHAR UNIQUE NOT NULL  , "value" BLOB, "added" INTEGER NOT NULL  DEFAULT 0, "endin" INTEGER NOT NULL  DEFAULT 0)');
            $object->exec('CREATE INDEX "lookup" ON "'.$this->$table.'" ("added" ASC, "endin" ASC)');
            $object->exec('VACUUM');
        }
    }

    // send all bugs to my email
    // you can replace it to your email
    // maximum 1 email per hour
    // you can use phpFastCache::bugs($title, $e) in any code
    public static function bugs($title, $e) {
        $code = md5("error_".$title);
        $send = $this->get($code);
        if($send == null) {
            $to = "khoaofgod@yahoo.com";
            $subject = "Bugs: ".$title;
            $message = "Error Serialize:".serialize($e);
            $from = "root@".$_SERVER['HTTP_HOST'];
            $headers = "From:" . $from;
            @mail($to,$subject,$message,$headers);
            $this->set($code,1,3600);
        }
    }

    // use for debug
    // public function, you can use phpFastCache::debug($e|array|string) any time in any code
    public static function debug($e, $exit = false) {
        echo "<pre>";
        print_r($e);
        echo "</pre>";
        if($exit == true) {
            exit;
        }
    }

    public static function startDebug($value,$text = "", $line = __LINE__, $func = __FUNCTION__) {
        if($this->$debugging == true) {
            $this->$step_debugging++;
            if(!is_array($value)) {
                echo "<br>".$this->$step_debugging." => ".$line." | ".$func." | ".$text." | ".$value;
            } else {
                echo "<br>".$this->$step_debugging." => ".$line." | ".$func." | ".$text." | ";
                print_r($value);
            }

        }
    }

}



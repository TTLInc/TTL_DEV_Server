<?php
/*
 * Copyright (c) 2012, IDM
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted
 * provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 *     * Neither the name of the IDM nor the names of its contributors may be used to endorse or
 *       promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

 
 

/*
 * Copyright (c) 2012, IDM
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted
 * provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 *     * Neither the name of the IDM nor the names of its contributors may be used to endorse or
 *       promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * Author: Arnaud de Bossoreille
 */

interface SkPublishAPIRequestHandler {

    public function prepareGetRequest($curl, $uri, &$headers);

}

class SkPublishAPI {

    function __construct($baseUrl, $accessKey) {
        $this->setBaseUrl($baseUrl);
        $this->setAccessKey($accessKey);
    }

    public function getAccessKey() {
        return $this->accessKey;
    }

    public function getBaseUrl() {
        return $this->baseUrl;
    }

    public function getDictionaries() {
        $curl = $this->prepareGetRequest($this->baseUrl."dictionaries");
        $response = curl_exec($curl);
		 
        return $response;
    }

    public function getDictionary($dictionaryCode) {
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $curl = $this->prepareGetRequest($this->baseUrl."dictionaries/".$dictionaryCode);
        $response = curl_exec($curl);
        return $response;
    }

    public function getEntry($dictionaryCode, $entryId, $format) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';
        $uri .= urlencode($entryId);
        $c = '?';
        if($format) {
            if(!$this->isValidEntryFormat($format))
                return null;
            $uri .= $c.'format='.$format;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getEntryPronunciations($dictionaryCode, $entryId, $lang = null) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';
        $uri .= urlencode($entryId);
        $uri .= '/pronunciations';
        $c = '?';
        if($lang) {
            if(!$this->isValidEntryLang($lang))
                return null;
            $uri .= $c.'lang='.$lang;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getNearbyEntries($dictionaryCode, $entryId, $entryNumber = null) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';
        $uri .= urlencode($entryId);
        $uri .= '/nearbyentries';
        $c = '?';
        if($entryNumber) {
            $uri .= $c.'entrynumber='.$entryNumber;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getRelatedEntries($dictionaryCode, $entryId) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/entries/';
        $uri .= urlencode($entryId);
        $uri .= '/relatedentries';
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getRequestHandler() {
        return $this->requestHandler;
    }

    public function getThesaurusList($dictionaryCode) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/topics/';
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getTopic($dictionaryCode, $thesName, $topicId) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/topics/';
        $uri .= urlencode($thesName);
        $uri .= '/';
        $uri .= urlencode($topicId);
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getWordOfTheDay($dictionaryCode = null, $day = null, $format = null) {
        $uri = $this->baseUrl;
        if($dictionaryCode) {
            if(!$this->isValidDictionaryCode($dictionaryCode))
                return null;
            $uri .= 'dictionaries/'.$dictionaryCode.'/';
        }
        $uri .= 'wordoftheday';
        $c = '?';
        if($day) {
            if(!$this->isValidWotdDay($day))
                return null;
            $uri .= $c.'day='.$day;
            $c = '&';
        }
        if($format) {
            if(!$this->isValidEntryFormat($format))
                return null;
            $uri .= $c.'format='.$format;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function getWordOfTheDayPreview($dictionaryCode = null, $day = null) {
        $uri = $this->baseUrl;
        if($dictionaryCode) {
            if(!$this->isValidDictionaryCode($dictionaryCode))
                return null;
            $uri .= 'dictionaries/'.$dictionaryCode.'/';
        }
        $uri .= 'wordoftheday/preview';
        $c = '?';
        if($day) {
            if(!$this->isValidWotdDay($day))
                return null;
            $uri .= $c.'day='.$day;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    private function isValidDictionaryCode($code) {
        if(strlen($code) < 1)
            return false;
        for($i = 0; $i < strlen($code); ++$i) {
            $c = substr($code, $i, 1);
            // Make sure no param are injected
            if($c == '/' || $c == '%')
                return false;
            if($c == '*' || $c == '$')
                return false;
        }
        return true;
    }

    private function isValidEntryFormat($format) {
        for($i = 0; $i < strlen($format); ++$i) {
            $c = substr($format, $i, 1);
            # Make sure no param are injected
            if($c == '/' || $c == '%')
                return false;
        }
        return true;
    }

    private function isValidEntryLang($lang) {
        for($i = 0; $i < strlen($lang); ++$i) {
            $c = substr($lang, $i, 1);
            # Make sure no param are injected
            if($c == '/' || $c == '%')
                return false;
        }
        return true;
    }

    private function isValidWotdDay($day) {
        for($i = 0; $i < strlen($day); ++$i) {
            $c = substr($day, $i, 1);
            # Make sure no param are injected
            if($c == '/' || $c == '%')
                return false;
        }
        return true;
    }

    private function prepareGetRequest($uri) {
	
	// echo"here";exit;
	//echo $uri;exit;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $uri);
		
        $headers = array();
        $headers[] = "accessKey: ".$this->accessKey;
        if($this->requestHandler) {
		//echo"now here";exit;
           $this->requestHandler->prepareGetRequest($curl, $uri, $headers);
        }
		//print_r($headers);exit;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		 
		
		 
//var_dump($response);
		//die();
        return $curl;
    }

    public function search($dictionaryCode, $searchWord, $pageSize = null, $pageIndex = null) {
        $uri = $this->baseUrl;
       // if(!$this->isValidDictionaryCode($dictionaryCode))
           // return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/search?q=';
        $uri .= urlencode($searchWord);
        $c = '&';
		  //echo $uri;exit;
        if($pageSize) {
            $uri .= $c.'pagesize='.$pageSize;
            $c = '&';
        }
        if($pageIndex) {
            $uri .= $c.'pageindex='.$pageIndex;
            $c = '&';
        }
		
		//echo $uri."lll";exit;
		
        $curl = $this->prepareGetRequest($uri);
		
		//var_dump($curl);exit;
		
        $response = curl_exec($curl);
		
		$res = curl_getinfo($curl);
		
 
//$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//curl_close($ch);
//echo $httpcode;
//echo $response;
 
		
		var_dump($res);
		exit;
		 
	//	var_dump(json_decode($response, true));
		 
        return $response;
    }

    public function searchFirst($dictionaryCode, $searchWord, $format = null) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/search/first?q=';
        $uri .= urlencode($searchWord);
        $c = '&';
        if($format) {
            if(!$this->isValidEntryFormat($format))
                return null;
            $uri .= $c.'format='.$format;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function didYouMean($dictionaryCode, $searchWord, $entryNumber = null) {
        $uri = $this->baseUrl;
        if(!$this->isValidDictionaryCode($dictionaryCode))
            return null;
        $uri .= 'dictionaries/'.$dictionaryCode.'/search/didyoumean?q=';
        $uri .= urlencode($searchWord);
        $c = '&';
        if($entryNumber) {
            $uri .= $c.'entrynumber='.$entryNumber;
            $c = '&';
        }
        $curl = $this->prepareGetRequest($uri);
        $response = curl_exec($curl);
        return $response;
    }

    public function setAccessKey($accessKey) {
        $this->accessKey = $accessKey;
    }

    public function setBaseUrl($baseUrl) {
        if(substr($baseUrl, -1) == '/')
            $this->baseUrl = $baseUrl;
        else
            $this->baseUrl = $baseUrl."/";
    }

    public function setRequestHandler($requestHandler) {
        $this->requestHandler = $requestHandler;
    }

}

 

 
 
 
//require 'include/SkPublishAPI.php';












class RequestHandler implements SkPublishAPIRequestHandler {

    public function prepareGetRequest($curl, $uri, &$headers) {
	 
         $headers[] = "Accept: application/json";
		//$headers[] ="Content-Type:application/json";
		 
		 
    }
}
// echo base_url();exit;
$baseUrl = "https://www.macmillandictionary.com/";
//$baseUrl = "http://techno-sanjay/dev.thetalklist.com/";
$accessKey = "cL7WyUGSyglugcY5WctOyCi5NbZxucTOalUWWUugxhHeTL18aaQtUTEsF3Sgz9Lg";
$requestHandler = new RequestHandler();

$api = new SkPublishAPI($baseUrl.'api/v1/', $accessKey);
$api->setRequestHandler($requestHandler);

$selDict = '';
if (!empty($_GET['dictCode'])) {
  $selDict = $_GET['dictCode'];
}

$dictionaries = json_decode($api->getDictionaries(), true);
 
sort($dictionaries);
?>

<html>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <style type='text/css'>
      body{
        font-family: Arial, sans-serif;
        font-size: 12px;
        padding: 0;
        margin: 0;
        background-color: #F0F0F0;
      }
      h1 {
        font-size: 25px;
        border-bottom: solid 1px #DDF;
        color: #008;
        margin: 10px 0px;
        padding: 0px;
      }

      h1.error{
        border: none;
        color: #A33;
        font-size: 20px;
        text-align: center;
      }

      h2 {
        font-size: 15px;
        color: #55C;
        margin: 15px 0px 5px 0px;
        padding: 0px;
      }

      .search{
        padding: 5px;
        margin: 0;
        border: solid 1px #CCC;
        width: 33%;
      }

      .dictSelect{
        padding: 4px;
        margin: 0;
        border: solid 1px #CCC;
        border-left: none;
      }

      input[type=submit]{
        padding: 6px;
        background-color: #88F;
        border: solid 1px #555;
        color: #FFF;
        font-weight: bold;
      }

      .header{
        text-align: center;
        background-color: #333;
        margin: 0 0 20px 0;
        padding: 10px;
        color: #FFF;
      }

      .menu{
        display: inline-block;
        float: left;
        padding: 10px 25px;
        font-size: 15px;
      }

      .menu a{
        color: #FFF;
      }

      form{
        margin: 0;
        padding: 0;
      }

      .content{
        padding: 0px 10px;
      }

      a{
        color: #65F;
        text-decoration: none;
        font-weight: bold;
      }

      a:hover{
        text-decoration: underline;
      }

    </style>
  </head>
  <body>
    <div class='header'>
      <form method='GET' action=''>
        <div class='menu'><a href='<?=$_SERVER['SCRIPT_NAME']?>'>Home</a></div>
        <input type='text' name='q' class='search' placeholder='Type a word or a phrase' />
        <select name='dictCode' class='dictSelect'>
        <?php //foreach($dictionaries as $dictionary){ ?>
          <option value='british'>Cambridge Advanced Learner's Dictionary</option>
        
		
		<?php //} ?></select>
        <input type='submit' value='Search' />
      </form>
    </div>
    <div class='content'>

<?php
if(!empty($_GET)){
  if(!empty($_GET['dictCode']) && !empty($_GET['q'])){ // SEARCH ENTRY
    $dictCode = $_GET['dictCode'];
    $lookup = $_GET['q'];
    $results = json_decode($api->search($dictCode, $lookup, 20, 1), true);
    if(empty($results['results'])){ // SEARCH MISSPELLING
      $didYouMean = json_decode($api->didYouMean($dictCode, $lookup,10),true);
      if(!empty($didYouMean["suggestions"])){
        ?>
        <h1>Spelling suggestion for <?=$lookup?></h1>
          <ul>
          <?php
          foreach( $didYouMean["suggestions"] as $sugestion ){
            ?><li><a href='<?=$_SERVER['SCRIPT_NAME']?>?dictCode=<?=$didYouMean['dictionaryCode']?>&q=<?=$sugestion?>'><?=$sugestion?></a></li><?php
          }
          ?>
          </ul>
        <?php
      }else{
        ?><h1 class='error'>There is no entry for <?=$lookup?></h1><?php
      }
    } elseif(count($results['results']) == 1){ // SHOW ENTRY
      $dictCode = $results['dictionaryCode'];
      $entryId = $results['results'][0]['entryId'];
      $entry = json_decode($api->getEntry($dictCode, $entryId, "html"),true);
      echo $entry['entryContent'];
    }else{
      ?>
      <h1>See below some entry suggestion for <?=$lookup?></h1>
        <ul>
        <?php
        foreach( $results['results'] as $result){
          ?><li><a href='<?=$_SERVER['SCRIPT_NAME']?>?dictCode=<?=$results['dictionaryCode']?>&entryId=<?=$result['entryId']?>'><?=$result['entryLabel']?></a></li><?php
        }
        ?>
        </ul>
      <?php
    }
  }elseif(!empty($_GET['dictCode']) && !empty($_GET['entryId'])){
    $dictCode = $_GET['dictCode'];
    $entryId = $_GET['entryId'];
    $entry = json_decode($api->getEntry($dictCode, $entryId, "html"),true);
    echo $entry['entryContent'];
  }else{
    ?><h1 class='error'>Each field must be filled</h1><?php
  }
}
?>
    </div>
  </body>
</html>


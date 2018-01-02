 <?php
    class Inner extends TL_Controller
    {
    function Inner()
        {
           parent::Controller();
    /*Set your own path here*/
   $this->_path = base_url('css/home');
   
	
    }
   function index()
   {
   echo "";
   }
   function js()
   {
           $segs = $this->uri->segment_array();
           foreach ($segs as $segment)
   {
               $filepath = $this->_path.$segment.'.js';
               if(file_exists($filepath))
   {
                   readfile($filepath);
   }
           }
       }
   function css()
   {
          echo $segs = $this->uri->segment_array();
		  echo "123";
		  exit;
           foreach ($segs as $segment)
   {
              $filepath = $this->_path.$segment.'.css';
			 
               if(file_exists($filepath))
   {
                   readfile($filepath);
   }
   }
  }
  }
  ?>

<?php

	class Visualizer
	{
				//private $dep; 
 		private $status;
				
        public function __construct($sts="")
        {
					
            $this->status =$sts;	
        }
        public function showMessage()
        {
			if($this->status=='EXIST')
			{
				include("usuario_existe.php");
            }
            elseif($this->status=='ERR')
            {
				require("usuario_error.php");
            }
            elseif($this->status=='REG_OK')
            {
                require("usuario_ok.php");
            }
            elseif($this->status=='NRF')
            {
                require("usuario_blank.php");
            }
			elseif($this->status=='UPD_OK')
            {
				require("usuario_upd_ok.php");
            }
			elseif($this->status=='DEL_OK')
            {
                require("usuario_del_ok.php");
			}
			require("bottomView.tpl.php");
		}
	}
?>
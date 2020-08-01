<?php 
   
   class Usuario
   {
       public  $login;
       public  $senha;
	   
	   public function setSenha( $senha) {
		   $this->senha =$senha;
	   }

       public function setLogin($login) {
	      $this->login =$login;
	   }  	  

       public function toString()
       {
         return "Login:" . $this->login;     
       }
       
       function validar($senha, $login) {		     	
           if((strcmp($this->login , $login) == 0) && (strcmp($this->senha , $senha) == 0)) 
                 return true;			
             return false;
	   }        		  
   }
?>

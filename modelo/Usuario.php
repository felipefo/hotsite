<?php 
   
   class Usuario
   {
       public  $login;
       public  $senha;
       public  $id;
       public  $role;
	   
	   public function setSenha( $senha) {
		   $this->senha =$senha;
	   }

       public function setLogin($login) {
	      $this->login =$login;
	   }  	  

       public function setId($id) {
         $this->id =$id;
       }  
       
       function getRole() {
           return $this->role;
       }

       function setRole($role) {
           $this->role = $role;
       }

              
       public function getId() {
         return $this->id;
       }  
           
       public function toString()
       {
         return "Login:" . $this->login;     
       }
       
       function validar($senha, $login) {           
           $salt ='hotsite'; 
           $hash = md5($salt . $senha);           
           if((strcmp($this->login , $login) == 0) && (strcmp($this->senha , $hash) == 0)) {
                 return $this->getRole();			
            }else {
              throw new Exception("Usuario invalido");
            }	
       }            
   }
?>

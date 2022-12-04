<?PHP   

    
       
        $hostname_localhost ="localhost";
        $database_localhost ="decoraci_decopino";
        $username_localhost ="decoraci_adsi200";
        $password_localhost ="los20pinos";
        
        $json=array();
        $time = time();
        $fecha=date("Y-m-d",$time);
        
        $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        
        $case=$_GET["case"];
        $id=$_GET["id"];
        $vista=$_GET["vista"];
        $compra=$_GET["compra"];
        $login=$_GET["login"];
        $correo=$_GET["correo"];
        $contra=$_GET["contra"];
        
		
		function Login($correo,$contra){
		   
		   
		    
		$hostname_localhost ="localhost";
        $database_localhost ="decoraci_decopino";
        $username_localhost ="decoraci_adsi200";
        $password_localhost ="los20pinos";
        
        $json=array();
        $time = time();
        $fecha=date("Y-m-d",$time);
        
        $conexion2 = mysqli_connect($hostname_localhost,$database_localhost,$username_localhost,$password_localhost);
        
		     $sql="select * from mususuario";
		     
            $rpta=mysqli_query($conexion2,$sql);
            
		    
            
            $registro=mysqli_fetch_array($rpta);
            
            if($registro['count(*)'] == 1){
                
                
                echo "ya esta";
                
            }else{
                
                
                
            }
		}
		
        Login($correo,$contra);
        
        
        
        switch ($case) {
        
         case 1:
			    $sql="SELECT * FROM `mprproductos` WHERE `estado`=1 ";
                
				if($id != null){   
        		$sql=$sql." and `id`= ".$id." ";
                }	
                
				if($vista != null){   
					$sql=$sql." ORDER BY vista DESC";
				}
				
				if($compra != null){   
					$sql=$sql." ORDER BY compra DESC";
				}
				


        		$rpta=mysqli_query($conexion,$sql);
        		// echo $sql;
        		
        		while($registro=mysqli_fetch_array($rpta)){
        		    $isRpta=true;
        		    $result["rp"]       ='ok';
        		    $result["id"]       =$registro['id'];
        			$result["nombre"]   =$registro['nombre'];
					$result["precio"]   =$registro['precio'];
        			$result["vistas"]	=$registro['vista'];	
        			$result["compras"]   =$registro['compra'];
					$result["tipo"]   	='producto';
        			$json['rpta'][]    	=$result;
                	}
                	
                	if(!$isRpta){
        	            $result["estado"]='No Existe';	
        				$json['rpta'][]=$result;
        	        }	
                	
            break;

		 case 2:
                $sql="SELECT * FROM `mprcombos` WHERE `estado`=1 ";

			    if($id != null){
			        $sql=$sql." and `id`= ".$id." ";
                }
                if($vista != null){
        		    $sql=$sql." ORDER BY vista DESC";
                }
                
                if($compra != null){   
					$sql=$sql." ORDER BY compras DESC";
				}
                
        		$rpta=mysqli_query($conexion,$sql);
        		
        		
        		while($registro=mysqli_fetch_array($rpta)){
        		    $isRpta=true;
        		    $result["rp"]       ='ok';
        		    $result["id"]       =$registro['id'];
        			$result["nombre"]   =$registro['nombre'];
        			$result["precio"]   =$registro['precio'];
        			$result["vistas"]	=$registro['vistas'];	
        			$result["compras"]   =$registro['compras'];
					$result["tipo"]   	='combo';
        			$json['rpta'][]    	=$result;
                	}
                	
                	if(!$isRpta){
        	            $result["estado"]='No Existe';	
        				$json['rpta'][]=$result;
        	        }

			break;
			
		 case 3:
		        $sql="SELECT * FROM `mprarticulos` WHERE `estado`=1 ";
		        
		        if($id != null){   
        		$sql=$sql." and `id`= ".$id." ";
                }	
				if($vista != null){   
					$sql=$sql." ORDER BY vista DESC";
				}
				if($compra != null){   
					$sql=$sql." ORDER BY compra DESC";
				}
				
				$rpta=mysqli_query($conexion,$sql);
        		
        		
        		while($registro=mysqli_fetch_array($rpta)){
        		    $isRpta=true;
        		    $result["rp"]       ='ok';
        		    $result["id"]       =$registro['id'];
        			$result["nombre"]   =$registro['nombre'];
        			$result["precio"]   =$registro['precio'];
        			$result["vistas"]	=$registro['vista'];	
        			$result["compras"]   =$registro['compra'];
					$result["tipo"]   	='articulo';
        			$json['rpta'][]    	=$result;
                	}
                	
                	if(!$isRpta){
        	            $result["estado"]='No Existe';	
        				$json['rpta'][]=$result;
        	        }

			break;
        }
        
        
        mysqli_close($conexion);
        echo json_encode($json);
        ?>
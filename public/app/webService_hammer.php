<?PHP   


       
        $hostname_localhost ="190.8.176.111";
        $database_localhost ="decoraci_prueba";
        $username_localhost ="decoraci_adsi200admin";
        $password_localhost ="aJZ[+&&3*,hX";
        //$database_localhost ="decoraci_decopino";
        //$username_localhost ="decoraci_adsi200";
        //$password_localhost ="los20pinos";
        
        
        $json=array();
        $time = time();
        $fecha=date("Y-m-d",$time);
        
        $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        
        if($conexion){
            echo("si");
        }else{
            echo("no");
        }
       
        $case=$_GET["case"];
  
        switch ($case) {
        
         case 1:
               
        		$sql="SELECT * FROM mprproductos WHERE estado=1";
        		$rpta=mysqli_query($conexion,$sql);
        	
        		
        		while($registro=mysqli_fetch_array($rpta)){
        		   
        		    $isRpta=true;
        		    $result["rp"]           ='ok';
        		    $result["id"]           =$registro['id'];
        			$result["nombre"]       =$registro['nombre'];
        			$result["precio"]       =$registro['precio'];
        			$result["iva"]          =$registro['iva'];
        			$result["descuento"]    =$registro['descuento'];
        			$result["existencia"]   =$registro['existencia'];
        			$result["estilo"]       =$registro['estilo'];
        			$result["dimension"]    =$registro['dimension'];
        			$result["peso"]         =$registro['peso'];
        			$result["material"]     =$registro['material'];
        			$result["color"]        =$registro['color'];
        			$result["tipopintura"]  =$registro['tipopintura'];
        			$result["Acabado"]      =$registro['Acabado'];
        			$result["imagen"]       =$registro['imagen'];
        			$result["detalle"]      =$registro['detalle'];
        			$result["vista"]        =$registro['vista'];
        			$result["compra"]       =$registro['compra'];
        			$result["garantia"]     =$registro['garantia'];
        			$result["Proveedor"]    =$registro['Proveedor'];
        			$result["linea"]        =$registro['linea'];
        			$result["categoria"]    =$registro['categoria'];
        			$result["estado"]       =$registro['estado'];
        			$result["fregistro"]    =$registro['fregistro'];
        			$result["factualizado"] =$registro['factualizado'];
        			$json['rpta'][]     =$result;
        			
        			
                	}
                	
                	if(!$isRpta){
        	            $result["rp"]       ='no';	
        				$json['rpta'][]=$result;
        	        }	
                	
         		break;
                
        }
        
     
        mysqli_close($conexion);
        echo $json["rpta"][1]["nombre"];
        echo(var_dump($json));

        ?>
        
        
        
        
        
        
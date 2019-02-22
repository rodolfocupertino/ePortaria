<?php 
	
	include_once ( ABSPATH . "includes/functions.php" );

	$dbaction 		= (string) $_POST['action'];
	$id				= (int) $_POST["id"];
	$name 			= $_POST["f_name"];
	

if ($dbaction == "new") {

	try { 

			    $service = $pdo->prepare("INSERT INTO services ( name ) VALUES(?)"); 
			    

			    try { 
			        
			        $pdo->beginTransaction(); 
			        $service->execute( array(  $name ) ); 
			        $lastId=$pdo->lastInsertId();

			        $pdo->commit(); 
			        //d("Registro $lastId gravado");
			        $msg->add("s", _("Service $name, gravado com Sucesso") );
			        redirect("services");

			    } catch(PDOExecption $e) { 
			        $pdo->rollback(); 
			        $msg->add("d", $e->getMessage() );			        
			    } 

			} catch( PDOExecption $e ) { 
				$msg->add("d", $e->getMessage() );
			    
			} 
	
	// log_user("INSERÇÃO", "NOVA AGENDA", $_SESSION['id_usuario']);
}

if ($dbaction == "edit") {

	try { 
			d("Entrou no edit");

		    $service = $pdo->prepare("UPDATE services SET  name=?  WHERE id=?"); 
		    
		   
		    try { 
		        
		        $pdo->beginTransaction(); 
		        $service->execute( array( $name , $id ) ); 

		        $pdo->commit(); 

		        $msg->add("s", _("Sucess") );
		        redirect("services");	
		        //redirect("client/edit/$id");

		    } catch(PDOExecption $e) { 
		        $pdo->rollback(); 
		        $msg->add("d", $e->getMessage() );
		        
		    } 

		} catch( PDOExecption $e ) { 
			$msg->add("d", $e->getMessage() );
		    
		} 

}

if ($dbaction == "delete") {
	
	try { 

	    $service = $pdo->prepare("UPDATE services SET deleted_at=NOW() WHERE id=? "); 

	    try { 
	        
	        $pdo->beginTransaction(); 
	        $service->execute( array( $id ) ); 
	        $pdo->commit(); 
	        $msg->add("s", _("Sucess") );
	        redirect("services");

	    } catch(PDOExecption $e) { 
	        $pdo->rollback(); 
	        $msg->add("d", $e->getMessage() );
	        
	    } 

	} catch( PDOExecption $e ) { 
		$msg->add("d", $e->getMessage() );
	    
	} 

	$msg->add("s", "Cliente $client_id Deletado com sucesso" );

	redirect("service");

}

if ($dbaction == "bulk_delete" ) {

	$total_deleted = count( $_POST['bulk_delete'] );

	foreach( $_POST['bulk_delete'] as $bulk_delete_id ) {

		try { 

		    $service = $pdo->prepare("UPDATE services SET deleted_at=NOW() WHERE id=? ");

		    try { 
		        //d($bulk_delete_id);
		        $pdo->beginTransaction(); 
		        $service->execute( array( $bulk_delete_id ) ); 
		        $pdo->commit(); 

		    } catch(PDOExecption $e) { 
		        $pdo->rollback(); 
		        $msg->add("d", $e->getMessage() );
		        
		    } 

		} catch( PDOExecption $e ) { 
			$msg->add("d", $e->getMessage() );
		    
		} 

	}

	$msg->add("s", "Total de ". $total_deleted . " deletado(s) " );

}

?>
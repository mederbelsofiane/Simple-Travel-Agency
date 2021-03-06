<?php
	
	
	function GetLastID(){
		include 'dbConnect.php';
		$sql="SELECT ID FROM packages ORDER BY id DESC LIMIT 1";
		$result = $conn->query($sql);
		$row_array=$result->fetch_array();
		$conn->close();
		return $row_array["ID"];
	}

	function InserIntotable($id,$PacName,$PacDuration,$PacTrans,$PacHotel,$PacAmount,$mobile,$img){
		include 'dbConnect.php';
		$sql='INSERT INTO packages (ID,Name,Duration,Hotel,Transport,Amount,Mobile,Img) VALUES('.$id.',"'.$PacName.'","'.$PacDuration.'","'.$PacHotel.'","'.$PacTrans.'","'.$PacAmount.'","'.$mobile.'","'.$img.'")';
		if( $conn->query($sql)===TRUE){
			$conn->close();
	  		return"OK";
	  	}else {
	  		$err=$conn->error;
	  		$conn->close();
	  		return $err;
	  	}
	}

	function showResult(){
		include 'dbConnect.php';
		$sql='SELECT * FROM packages';
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$data="";
            while($row = $result->fetch_assoc()) {
            	$data.='<div class="col-md-8 col-md-offset-2 thumbnail well slideanim">
			        <img src="'.$row["Img"].'" class="img-responsive" style="width:100%;height: 300px;"  alt="Image">
			        <h1 style="color: #f4511e; border-bottom: 2px solid #f4511e; padding-bottom: 5px;">'.$row["Name"].'</h1>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Duration: </strong> '.$row["Duration"].'</h3>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Hotel: </strong> '.$row["Hotel"].'</h3>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Transport: </strong>'.$row["Transport"].'</h3>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Amount: </strong> '.$row["Amount"].'</h3>
			        <h3 style="color: black; padding-bottom: 5px;"><strong>Call: </strong>'.$row["Mobile"].'</h3>
			    </div>';
            }
            $conn->close();
            return $data;
        }else{
        	$conn->close();
        	return '<h1 class="alert alert-danger" style="margin-top: 50px ;text-aligh:center">Package Aren\'t Available.</h1>';
        }
	}

	function Is_auth(){
		if(isset($_SESSION["status"]) && $_SESSION["status"] == "ADMIN")
			return "yes";
		else return "no";
	}

	function GiveIT($name){
		include 'dbConnect.php';
			$sql='SELECT * FROM packages WHERE Name="'.$name.'"';
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$data='<div class="col-md-8 col-md-offset-2 thumbnail well">
			        <img src="'.$row["Img"].'" class="img-responsive" style="width:100%;height: 300px;"  alt="Image">
			        <h1 style="color: #f4511e; border-bottom: 2px solid #f4511e; padding-bottom: 5px;">'.$row["Name"].'</h1>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Duration: </strong> '.$row["Duration"].'</h3>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Hotel: </strong> '.$row["Hotel"].'</h3>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Transport: </strong>'.$row["Transport"].'</h3>
			        <h3 style="color: black; border-bottom: 2px solid #f4511e; padding-bottom: 5px;"><strong>Amount: </strong> '.$row["Amount"].'</h3>
			        <h3 style="color: black; padding-bottom: 5px;"><strong>Call: </strong>'.$row["Mobile"].'</h3>
			       <button class="btn btn-primary" id="delete"> Delete It.</button>
			    </div>';
				$conn->close();
				return $data;
			}else{
				return '<h3 class="alert alert-danger">Package Aren\'t Available.</h3>';
			}
	}

	function DeleteIT($name){

		include 'dbConnect.php';
		$sql='DELETE FROM packages WHERE Name="'.$name.'"';
		if( $conn->query($sql)===TRUE){
			$conn->close();
	  		return '<h1 class="alert alert-success" style="text-aligh:center">Package Removed.</h1>';
	  	}else {
	  		$err=$conn->error;
	  		$conn->close();
	  		return $err;
	  	}
	}
?>
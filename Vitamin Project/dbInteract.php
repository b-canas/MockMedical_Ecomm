<?php
	
	//use include dbInteract.php to access this file in other files
	
	
	function servername() {return "localhost";}
	function serveruser() {return "root";}
	function serverword() {return "";}
	function db() {return "se2_medicine";}
	
	function getcon() {
		$servername=servername();
		$serveruser=serveruser();
		$serverword=serverword();
		$mycon = new mysqli($servername,$serveruser,$serverword);
		
		if($mycon->connect_errno) {
			echo "Critical failure to connect to database: ". $con->connect_error;
			exit();
		}
		else {
			echo "(./) ";
		}
		
		return $mycon;
	}
	
	//returns the insertion
	function insertUser($v_username,$v_password,$v_access,$v_fname,$v_lname,$v_address,$v_phone,$v_email) {
		$db=db();
		$mycon=getcon();
		
		$query = "SELECT * FROM $db.users WHERE USERNAME=?";
		$stmt=$mycon->prepare($query);
		$stmt->bind_param("s",$v_username);
		$stmt->execute();
		$result=$stmt->get_result();
		
		$first=getAssFirst($result);
		if($first!=null) {
			echo "username $v_username in table<br>";
			return false;
		}
		else {
			echo "username $v_username not in $db.users<br>";
		}
		
		$hashword=password_hash($v_password,PASSWORD_DEFAULT);
		
		$query="INSERT INTO $db.users (USERNAME,PASSWORD,ACCESS,FNAME,LNAME,ADDRESS,PHONE,EMAIL) VALUES (?,?,?,?,?,?,?,?);";
		
		$stmt=$mycon->prepare($query);
		$stmt->bind_param("ssisssss",$v_username,$hashword,$v_access,$v_fname,$v_lname,$v_address,$v_phone,$v_email);
		$stmt->execute();
		$result=$stmt->get_result();
		$affected=$stmt->affected_rows;
		print($affected);
		echo "<br>";
		print_r($mycon->error_list);
		echo "<br>";	
		return $affected;
	}
	
	function loginUser($v_username,$v_password) {
		$db=db();
		$mycon=getcon();
		
		//get our row
		$query = "SELECT * FROM $db.users WHERE USERNAME=?";
		$stmt=$mycon->prepare($query);
		$stmt->bind_param("s",$v_username);
		$stmt->execute();
		
		$result=$stmt->get_result();
		
		//nab values if non-null
		$assoc=getAssFirst($result);
		if($assoc!=null) {
			$userid=$assoc['USERID'];
			$hashword=$assoc['PASSWORD'];
			$access=$assoc['ACCESS'];
			//assure pw is correct
			$login=password_verify($v_password,$hashword);
			if($login) {
				//fill return
				$ret=[];
				$ret['username']=$v_username;
				$ret['password']=$v_password;
				$ret['userid']=$userid;
				$ret['access']=$access;
				return $ret;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
		return false;
	}
	
	function updateUser($v_userid,$v_username,$v_password,$v_access,$v_fname,$v_lname,$v_address,$v_phone,$v_email) {
		$mycon=getcon();
		$db=db();
		
		$query="SELECT * FROM $db.users WHERE USERID=$v_userid";
		$result=$mycon->query($query);
		$first=getAssFirst($result);
		
		if($v_username=="")
			$v_username=$first['USERNAME'];
		
		$hashword="";
		if($v_password=="")
			$hashword=$first['PASSWORD'];
		else {
			$hashword=password_hash($v_password,PASSWORD_DEFAULT);
		}
		
		if($v_access=="")
			$v_access=$first['ACCESS'];
		if($v_fname=="")
			$v_fname=$first['FNAME'];
		if($v_lname=="")
			$v_lname=$first['LNAME'];
		if($v_address=="")
			$v_address=$first['ADDRESS'];
		if($v_phone=="")
			$v_phone=$first['PHONE'];
		if($v_email=="")
			$v_email=$first['EMAIL'];
		
		$query="UPDATE $db.users SET USERNAME=?,PASSWORD=?,ACCESS=?,FNAME=?,LNAME=?,ADDRESS=?,PHONE=?,EMAIL=?";
		
		$stmt=$mycon->prepare($query);
		$stmt->bind_param("ssisssss",$v_username,$hashword,$v_access,$v_fname,$v_lname,$v_address,$v_phone,$v_email);
		$stmt->execute();
		$result=$stmt->get_result();
		return $result->affected_rows;
	}
	
	function getAssFirst($result) {
		while($row=$result->fetch_assoc()) {
			return $row;
		}
		return null;
	}
	
	function getProducts() {
		$db=db();
		
		
		$query = "SELECT * FROM $db.products";
		$result=q($query);
		return $result;
	}
	
	function getProduct($v_productid) {
		$db=db();
		$query="SELECT * FROM $db.products WHERE PRODUCTID=$v_productid";
		$result=q($query);
		$first=getAssFirst($result);
		return $first;
	}
	
	function addItemToCart($v_userid,$v_productid,$v_amount) {
		echo "aitc($v_userid,$v_productid,$v_amount) - ";
		if($v_amount==="") {
			echo "$v_amount===\"\" - ";
			return 0;
		}
		echo "aitc|a!=\"\" - ";
		$mycon=getcon();
		$db=db();
		$query="SELECT * FROM $db.carts WHERE USERID=$v_userid AND PRODUCTID=$v_productid";
		$result=$mycon->query($query);
		
		$first=getAssFirst($result);
		echo "aitc|b|";
		nl();
		if($first!=null) {
			if($v_amount<=0) {
				echo "aitc|u<0|";
				nl();
				$query = "DELETE FROM $db.carts WHERE USERID=$v_userid AND PRODUCTID=$v_productid";
			}
			else  {
				echo "aitc|U|";
				nl();
				$query = "UPDATE $db.carts SET AMOUNT=$v_amount WHERE USERID=$v_userid AND PRODUCTID=$v_productid";
			}
		}
		else {
			if($v_amount<0) {
				echo "aitc|i<0|";
				nl();
				echo "amount $v_amount is not enough";
				return 0;
			}
			else {
				echo "aitc|I|";
				nl();
				$query = "INSERT INTO $db.carts (USERID,PRODUCTID,AMOUNT) VALUES ($v_userid,$v_productid,$v_amount)";
				echo "inserting additem ";
			}
		}
		echo "id:$v_userid,pid:$v_productid,amt:$v_amount";
		nl();
		
		$result=$mycon->query($query);
		$affected=$mycon->affected_rows;
		return $affected;
	}
	
	function nl() {
		
		echo "<br>";
	}
	
	function q($query) {
		$mycon=getcon();
		$result=$mycon->query($query);
		$el=$mycon->error_list;
		if(!empty($el)) {
			echo "ERROR_LIST: ";
			print_r($el);
			echo "# ";
		}
		return $result;
	}
	
	function getCart($v_userid) {
		$db=db();
		$query = "SELECT * FROM $db.carts WHERE USERID=$v_userid";
		$result=q($query);
		return $result;
	}
	
	
	function updateCart($v_post,$v_userid) {
		$products=getProducts();
		echo "uc|b|";
		nl();
		while($row=$products->fetch_assoc()) {
			$productid=$row['PRODUCTID'];
			
			$amount=0;
			
			if(isset($v_post["$productid"])&&$v_post["$productid"]!="") {
				echo "$productid is set with $amount";
				nl();
				$amount=$v_post["$productid"];
			}
			else {
				echo "$productid not set ";
				nl();
				continue;
			}
			echo "aitc($v_userid,$productid,$amount)";
			nl();
			addItemToCart($v_userid,$productid,$amount);
		}
	}
	
	function verifyCredentials($v_args) {
		$dummy=true;
		return $dummy;
	}
	
	function checkoutUser($v_userid,$v_args) {
		if(!verifyCredentials($v_args)) {
			echo "Credentials failed to verify!  Forfeit the stolen goods or be prepared to pay with your life!";
			return false;
		}
		echo "checkout|v|";
		nl();
		$cart=getCart($v_userid);
		if($cart->num_rows<1) {
			echo "cart empty!";
			return false;
		}
		while($row=$cart->fetch_assoc()) {
			print_r($row);
			echo "-";
			$camount=$row['AMOUNT'];
			$productid=$row['PRODUCTID'];
			
			$product=getProduct($productid);
			$pstock=$product['PSTOCK'];
			
			if($camount>$pstock) {
				$fail_reason="Not enough in stock for $productid ($camount wanted vs $pstock)";
				echo $fail_reason;
				nl();
				return $fail_reason;
			}
		}
		echo "checkout|s|";
		nl();
		$orderno=insertOrder($v_userid);
		
		$cart=getCart($v_userid);
		$total_cost=0;
		while($row=$cart->fetch_assoc()) {
			print_r($row);
			echo " - ";
			
			$camount=$row['AMOUNT'];
			$productid=$row['PRODUCTID'];
			
			$product=getProduct($productid);
			$pstock=$product['PSTOCK'];
			$price=$product['PRICE'];
			
			$namount=$pstock-$camount;
			
			$tprice=$price*$camount;
			$total_cost+=$tprice;
			
			updateProduct($productid,"",$namount,"");
			echo "cu.up($productid,-,$namount,-) - ";
			nl();
			$tprice=$camount*$price;
			insertOrderEntry($orderno,$v_userid,$productid,$camount,$price,$tprice);
			echo "cu.ioe($productid,-,$namount,-) - ";
			nl();
			$noitems=0;
			echo "cu.aitc-v: ";
			addItemToCart($v_userid,$productid,$noitems);
			echo "cu.aitc-^($v_userid,$productid,$noitems) - ";
			echo "rev.";
			nl();
			nl();
		}
		updateOrder($orderno,"",$total_cost);
		echo "checkout|o|";
		nl();
		return true;
	}
	
	function insertProduct($v_pname,$v_pstock,$v_price) {
		$db=db();
		
		$query="INSERT INTO $db.products (PNAME,PSTOCK,PRICE) VALUES ($v_pname,$v_pstock,$v_price)";
		$result=q($query);
		return $result->affected_rows;
	}
	
	function updateProduct($v_productid,$v_pname,$v_pstock,$v_price) {
		$db=db();
		
		$query="UPDATE $db.products SET ";
		if($v_pname!="")
			$query .= "PNAME='$v_pname',";
		if($v_pstock!="")
			$query .="PSTOCK=$v_pstock,";
		if($v_price!="")
			$query .="$v_price,";
		
		$query=substr($query,0,-1);
		
		$query .=" WHERE PRODUCTID=$v_productid";
		echo $query;
		nl();
		
		$result=q($query);
		return $result;
	}
	
	function deleteProduct($v_productid) {
		$db=db();
		
		$query ="DELETE FROM $db.products WHERE PRODUCTID=$$v_productid";
		$result=q($query);
		return $result->affected_rows;
	}
	
	function statusReady() {return 'READY';}
	
	function insertOrder($v_userid) {
		echo "insertOrder($v_userid) - ";
		$db=db();
		
		$status=statusReady();
		$query="INSERT INTO $db.orderno (USERID,TOTALCOST,STATUS) VALUES ($v_userid,0,'$status')";
		q($query);
		echo "insertOrder|q| - ";
		$query="SELECT * FROM $db.orderno WHERE USERID=$v_userid";
		$result=q($query);
		echo "insertOrder|q2| - ";
		$max=0;
		while($row=$result->fetch_assoc()) {
			$orderno=$row['ORDERNO'];
			if($orderno>$max)
				$max=$orderno;
		}
		echo "insertOrder|:$max# ";
		return $max;
	}
	
	function insertOrderEntry($v_orderno,$v_userid,$v_productid,$v_amount,$v_icost) {
		echo "insertOrderEntry($v_orderno,$v_userid,$v_productid,$v_amount,$v_icost)";
		$db=db();
		
		$tprice=$v_amount*$v_icost;
		$query="INSERT INTO $db.orders (ORDERNO,USERID,PRODUCTID,AMOUNT,ICOST,TPRICE) VALUES ($v_orderno,$v_userid,$v_productid,$v_amount,$v_icost,$tprice)";
		$result=q($query);
		
		return $result;
	}
	
	function getOrdernos() {
		$db=db();
		
		$query = "SELECT * FROM $db.orderno";
		$result=q($query);
		return $result;
	}
	
	function getOrdernoFromUser($v_userid) {
		$db=db();
		//echo "gonfu($v_userid) - ";
		$query="SELECT * FROM $db.orderno WHERE USERID=$v_userid;";
		$result=q($query);
		
		//echo "gonfu: ";
		//print_r($result);
		//echo "# ";
		return $result;
	}
	
	function getOrdersFromUser($v_userid,$v_orderno) {
		$db=db();
		//echo "gofu($v_userid) - ";
		$query="SELECT * FROM $db.orders WHERE USERID=$v_userid AND ORDERNO=$v_orderno;";
		$result=q($query);
		
		//echo "gofu: ";
		//print_r($result);
		//echo "# ";
		return $result;
	}
	
	function updateOrder($orderno,$v_status,$v_totalcost) {
		echo "updateOrder($orderno,$v_status,$v_totalcost) - ";
		$db=db();
		$query="UPDATE $db.orderno SET ";
		if(!($v_status===""))
			$query .= "STATUS='$v_status', ";
		if(!($v_totalcost===""))
			$query .= "TOTALCOST=$v_totalcost, ";
		
		$query .= "LASTMOD=now() WHERE ORDERNO=$orderno";
		$result=q($query);
		echo "updateOrder: $result x# ";
		return $result;
	}
	
	function getUser($v_userid) {
		echo "getUser($v_userid) - ";
		$db=db();
		$query="SELECT * FROM $db.users WHERE USERID=$v_userid";
		$result=q($query);
		$first=getAssFirst($result);
		
		echo "getUser: ";
		//print_r($first);
		echo " # ";
		return $first;
	}
?>






















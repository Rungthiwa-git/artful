<?php
ob_start();
session_start();
include 'condb.php';

if(!isset($_SESSION["intLine"]))    //เช็คว่าแถวเป็นค่าว่างมั๊ย ถ้าว่างให้ทำงานใน {}
{
	 $_SESSION["intLine"] = 0;
	 $_SESSION["strPictureID"][0] = $_GET["PICTURE_ID"];   //รหัสสินค้า

	 header("location:cart.php");
}
else
{
	
	$key = array_search($_GET["PICTURE_ID"], $_SESSION["strProductID"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
	}
	else
	{
		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strProductID"][$intNewLine] = $_GET["id"];
		 $_SESSION["strQty"][$intNewLine] = 1;
	}
	 header("location:cart.php");
}
?>
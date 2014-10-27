<?php 
class MenuItem{
	private $itemName = "";
	private $description = "";
	private $price = 0.0;
	
	function __construct($iName, $iDesc, $iPrice){
		$this->itemName = $iName;
		$this->description = $iDesc;
		$this->price = $iPrice;
	}
	
	function getItemName(){
		return $this->itemName;
	}
	
	function setItemName($name){
		$this->itemName = $name;
	}
	
	function getDescription(){
		return $this->description;
	}
	
	function setDescription($desc){
		$this->description = $desc;
	}
	
	function getPrice(){
		return $this->price;
	}
	
	function setPrice($pMoney){
		$this->price = $pMoney;
	}
}
?>

<?php
	echo '<!DOCTYPE html>';
	echo '<html>';
	echo '<head>';
	echo "<title>WP Eatery - ". "$pageTitle"."</title>";
?>
<?php
	$myHeader = <<<THEEND
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href='http://fonts.googleapis.com/css?family=Fugaz+One|Muli|Open+Sans:400,700,800' rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <header class="clearfix">
                <img src="images/header_img.jpg" alt="Dining Room" title="WP Eatery"/>
                <div id="title">
                    <h1>WP Eatery</h1>
                    <h2>1385 Woodroffe Ave, Ottawa ON</h2>
                    <h2>Tel: (613)727-4723</h2>
                </div>
            </header>
            <nav>
                <div id="menuItems">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="contact.php">Contact</a></li>
						<li><a href="mailing_list.php">List</a></li>
                    </ul>
                </div>
            </nav>
THEEND;
	echo $myHeader;
?>
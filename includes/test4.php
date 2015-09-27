<?php 
include('configure.php');
$query = "CREATE TABLE news (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(2500) DEFAULT NULL,
  `status2` tinyint(3) DEFAULT '1',
  `orderno` tinyint(3) DEFAULT '0',
  `datemodified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
)";
mysqli_query($mysqli, $query);

?>

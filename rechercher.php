<!DOCTYPE html>
<html lang="fr">
<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Indexation</title>
    <link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/css/mystyle.css"> 

    <style type="text/css">
    .lientitre{
	  font-size: 17px;
	  color: #0039e6;
	  
	}
	.liensource{
	  font-size: 13px;
	  color: green;
	  
	}
	.descriptif{
	  font-size: 15px;
	  color: #808080;
	  
	}

	
    </style>




</head>
<body>

<div class="navbar "> </div>

<div class="col-md-6  col-md-offset-3">

    <div class=" panel-info spacer">
    	<center><img src="image1.jpg" alt="image de l'application" width="200" height="150"></center>
          
        <div class="panel-body">
        	  <form method="post" action="rechercher.php">
                <div class="form-group" glyphicon glyphicon-search">
                    <input type="text" name="query" class="search-query form-control" placeholder="veuillez saisir un mot..." required>
                </div>

                <div >
                    <button type="submit" class="btn btn-primary btn-md col-md-2  col-md-offset-5">Rechercher</button>
                </div>
            </form>

        </div>
    </div>	
<?php 

//$url = "file:///C:\xampp\htdocs\med\indexation10";
if(isset($_POST["query"])){
	$query = $_POST["query"];

	$connexion = mysqli_connect("localhost","root","","tiw");
		//reécupérer les données
	$sql = " SELECT idSource,source,titre,descriptif,poids,mot FROM ((document
	LEFT JOIN  mot_document ON document.id= mot_document.idSource)
	RIGHT join mot ON mot.id = mot_document.idMot)
	where mot.mot = '$query' order by poids desc";
        

	$resultat = mysqli_query($connexion,$sql);
	-
	$nombre= mysqli_num_rows($resultat);
	
	echo "Resultat pour le mot : $query :  ".$nombre."<br>";
	
	$i = 1;
	while ($ligne = mysqli_fetch_row($resultat)) {
		 

		echo"<a class='lientitre' href='$ligne[1]' title='Titre du document'> $ligne[2]</a><br>";

		echo "<a class='liensource' href='$ligne[1]' title='La source'>$ligne[1] ($ligne[4]) </a><br>";  
		
		echo  "<div class='descriptif'> $ligne[3] <br> </div>";
	 }  

			 
	  
		
		
		
}


?>
</body>
</html>
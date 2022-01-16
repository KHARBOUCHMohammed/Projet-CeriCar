<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <!--Font -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--Jquery -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- CSS-->
   
    <link rel="stylesheet" type="text/css" href="css/identifer.css">
    <link rel="stylesheet" href="css/bandofooter.css">
    <link rel="stylesheet" href="css/hamid.css">

   <!--Ajax-->
 
   <script src="js/header.js" type="text/javascript"></script>
  <script src="js/rechercheVoyage.js" type="text/javascript"></script>
  <script src="js/identification.js" type="text/javascript"></script>
  <script src="js/mesResvation.js" type="text/javascript"></script>
  <script src="js/mesvoyage.js" type="text/javascript"></script>
  <script src="js/newvoyage.js" type="text/javascript"></script>
  <script src="js/prpVoyage.js" type="text/javascript"></script>
  <script src="js/afficherVoyage.js" type="text/javascript"></script>
  <script src="js/reserver.js" type="text/javascript"></script>
  
	
    <title>
        monApp 
    </title>

</head>

<body>


    <header id="header">
            <?php include("monApplication/view/headerSuccess.php")?>
            
    </header>

   <!-- Bandeau -->
    <div class="container" style="margin-top:75px">
    <div id="banner">
    <?php
        if($context->error)
          echo 'Erreur lors de la connexion a la base de donn�e ' ;
        else
          echo 'action :  ' .$action. ' Reussite';
        
        ?>
  
    </div>
    <br>
        <?php if($context->error): ?>
        <div id="flash_error" class="error">
            <?php echo " $context->error !" ?>
        </div>
        <?php endif; ?>


        <div id="page_maincontent">
           
        <?php include($template_view); ?>
           
           <?php
                /*foreach($template_views as $view)
                {
                    //assigne le nom de la vue � matches[1]
                    preg_match('/'.$nameApp.'\/view\/(.*?)\.php/',$view, $matches);
                    echo "<div id=".$matches[1].">\n";
                    include($view);
                    echo "</div>\n";
                }*/
          
        ?>
     
    </div>
    
    <!--Footer -->
    

    
    <footer>

  
       
            
            
        </div>
</footer>

 
</body>

</html>

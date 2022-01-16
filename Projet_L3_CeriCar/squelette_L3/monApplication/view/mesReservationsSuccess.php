<div id="container">
    <div id="maincontent">    

          <div class="col" > 
            <div class="rounded-lg">
                <div class="col col-lg "style = "font-size: 27px; font-weight: 600; font-family: 'Trebuchet MS', serif;text-align:center;padding-top:20px;">
                    <p style="color:#34568B;font-size: 30px;font-weight: 550;">Mes Réservations</p>
                </div>
  



<table id="voyages" class="table table-hover" >
  <thead>
    <tr>
      <th>depart</th>
      <th>arrivee</th>
      <th>heure depart</th>
      <th>heure arrivee</th>
      <th>conducteur</th>
      <th>places Restantes </th>
    </tr>
  </thead>


   <?php //foreach($context->allReservations as $reservation): 
            foreach($context->voyages as $voyage): ?>
      <tr>
        <!-- colonne0 : depart -->
        <td ><?php  echo $voyage->voyage->trajet->depart; ?></td>
      
        <!-- colonne1 : arrivee -->
        <td><?php echo $voyage->voyage->trajet->arrivee;?></td>
    
        <!-- colonne2 :  heure depart -->
        <td><?php echo $voyage->dureeFormat;?></td>

        <!-- colonne2 :  heure arrivee -->
        <td><?php echo $voyage->arriveeFormat;?></td>
      
      
        <!-- colonne3 : condicteur -->
        <td><?php echo $voyage->voyage->conducteur->nom." ".$voyage->voyage->conducteur->prenom?></td>
        <!-- colonne3 : places -->
        <td><?php echo $voyage->placeReserve?></td>   
      </tr>
    <?php// endforeach; ?>
  <?php endforeach; ?>
</table>
<?php if(count($context->voyagesCorrespendance)>0) { ?>
<div class="alert alert-success" role="alert">
  <?php echo count($context->voyagesCorrespendance) ?> Voyage(s) trouvé(s)
</div>

	
	 

<?php
	 

	
	 foreach($context->voyagesCorrespendance as $voyage){?>

	 <div class="card bg-light text-dark rounded-lg" role="button" data-id="<?php 
			$array = array();
			foreach($context->listvoyages[$voyage->id] as $voyages){
				array_push($array,$voyages->id);}
				echo json_encode($array);
			 ?>" data-contraintes="<?php echo $voyage->contraintes ?>"  data-distance="<?php echo $voyage->trajet->distance ?>"  >
    	<div class="card-body" >
			<div class="row">
				<div class="col col-lg-4" >
					<ul class="list-group " >
						<li class="list-group-item border-0">
							<div class="col">
								<span id="cardHeureDepart" name="cardHeureDepart"  data-id="<?php echo $voyage->heuredepart ?>"><?php echo $voyage->heuredepart?>:00</span>
							</div>
							<div class="col" >
								<p id="cardDepart" name="cardDepart"  data-id="<?php echo $voyage->trajet->depart?>"><?php echo $voyage->trajet->depart ?></p>
							</div>
						</li>
						<li class="list-group-item border-0" >
						<div class="col">
								<span id="cardHeureArrivee" name="cardHeureArrivee"  data-id="<?php echo $context->heurearrivee[$voyage->id] ?>"><?php echo $context->heurearrivee[$voyage->id]?>:00</span>
							</div>
							<div class="col" >
								<p id="cardArrivee" name="cardArrivee"  data-id="<?php echo $voyage->trajet->arrivee ?>"><?php echo $voyage->trajet->arrivee ?></p>
							</div>
						</li>
						
					</ul>
					
				</div>
				
				
				<div class="col col-md-4" style="padding-right:0px;">
					<div class="col" style="text-align:right;">
						<span id="cardTarif" name="cardTarif" data-id="<?php echo $voyage->tarif ?>"><?php echo $voyage->tarif ?> € </span>
					</div>
					<div class="col" style="margin-left:10px;text-align:right;">
                		<p id="cardConducteur" name="cardConducteur"  data-id="<?php 
						$array = array();
						foreach($context->conducteurs[$voyage->id] as $conducteurs){
							array_push($array,$conducteurs->id);}
							echo json_encode($array);
						?>">
						<?php foreach($context->conducteurs[$voyage->id] as $conducteurs){
							echo $conducteurs->nom." ".$conducteurs->prenom."/"; }?>
							</p>
            		</div>
					<div class="col" style="margin-left:10px;text-align:right;">
                		<p style="color: #2ecc71;font-size: 22px;line-height: 20px;font-family: 'Trebuchet MS', serif;" data-id="<?php echo $voyage->nbplace ?>" ><?php echo $voyage->nbplace?>  Place restantes </p>
            		</div>
					
            	</div>

			</div>
				
		</div>
  	</div>

	  <hr style="height: 2px;">
	 	
	 <?php }
	 ?>



<?php }else {  ?>
	<div class="alert alert-danger" role="alert">
 		 Aucun résultat
	</div>
<?php }?>


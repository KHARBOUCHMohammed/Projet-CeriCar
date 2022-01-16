<?php //echo $context->voyages->id ;?>
<?php //echo"  ". $context->voyages->depart." ";?>
<?php //echo"  ". $context->voyages->arrivee." ";?>
<?php //echo"  ". $context->voyages->distance." ";?>
<?php //echo $context->voyages->tarif;?>




<?php if($context->voyages==null): ?>
    <div class='alert alert-warning'>
        <strong>Error sorry : </strong>
     Aucun voyage n'a ete trouve dans la base de donnee !!!!!
      </div>
<?php endif; ?>

<table id="voyages" class="table table-hover" >
    <thead>
        <tr>
            <th>Conducteur</th>
            <th>Tarif</th>
            <th>Nombre de place</th>
            <th>Heur de depart</th>
            <th>Contraintes</th>
        </tr>
    </thead>
    <?php if($context->voyages!=null): ?>
        <?php foreach($context->voyages as $voyage): ?>
            <tr>
            
                <td ><?php echo $voyage->conducteur->prenom . "   " . $voyage->conducteur->nom; ?></td>
            
                <td><?php echo $voyage->tarif . ' € '; ?></td>
            
            
                <td><?php echo $voyage->nbplace . '   '; ?></td>
            
                
                <td><?php echo $voyage->heuredepart . ' h'; ?></td>
                
                 <td><?php echo $voyage->contraintes  ; ?></td>

                
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
</section>
</div>


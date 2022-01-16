<?php if($context->user == null) : ?>
Aucune utilisateur n'a été trouvé
<?php else : ?>
Bonjour <?php echo "Id : ",$context->user->id,"  prenom : ",$context->user->prenom,"   Nom:   ",$context->user->nom ?> !
<?php endif; ?>

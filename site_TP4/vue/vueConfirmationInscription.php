<?php if (isset($inscrit)) : ?>
    <?php if ($inscrit) : ?>
        <div style="padding:2rem;background: rebeccapurple; color:white;">Utilisateur bien crée</div>
    <?php else : ?>
        <div style="padding:2rem;background: yellowgreen; color:white;">Utilisateur non crée</div>
    <?php endif; ?>
<?php else : ?>
    <div>Variable non utilisable</div>
<?php endif; ?>
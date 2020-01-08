
<h1>Mon profil</h1>

Mon adresse électronique : <?= $util["mailU"] ?> <br />
Mon pseudo : <?= $util["pseudoU"] ?> <br />

<hr>
<?php if(isset($mesRestosAimes)): ?>
    les restaurants que j'aime : <br>
    <?php foreach($mesRestosAimes as $value): ?>
    <a  href="./?action=detail&idR=<?= $value['idR'] ?>"><?= $value['nomR']?></a><br>
<hr>
<?php endforeach ?>
<?php endif ?>
les types de cuisine que j'aime : 
<ul id="tagFood">	
<?php foreach($mesTypeCuisineAimes as $value): ?>
    <li class="tag"><span class="tag">#</span><?= $value['libelleTC']?></li>
  
    <?php endforeach ?>
</ul>
<hr>
<a href="./?action=deconnexion">se deconnecter</a>



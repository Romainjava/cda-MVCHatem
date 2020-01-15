<h1>Ici vue mon profil admin</h1>
<a class="btn" href="./?action=deconnexion">se deconnecter</a>
<?php if (isset($utilisateurs)) : ?>

    <table>
        <tbody>
            <td><strong>Pseudo</strong></td>
            <td><strong>Mail</strong></td>
            <td><strong>Etat</strong></td>
            <?php foreach ($utilisateurs as $value) : ?>

                <tr>
                    <td><?= $value['pseudoU'] ?></td>
                    <td><?= $value['mailU'] ?></td>

                    <?php if ($value['etat'] == 0) : ?>
                        <td>Non Banni</td>
                        <td> <a class="bannir" href="./?action=ban&mailU=<?= $value['mailU'] ?>">Bannir</a> </td>
                    <?php else : ?>
                        <td><a class="bannir" href="./?action=unban&mailU=<?= $value['mailU'] ?>">Unban</a></td>
                    <?php endif; ?>

                </tr>
        </tbody>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
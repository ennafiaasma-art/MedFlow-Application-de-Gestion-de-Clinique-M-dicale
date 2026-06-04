<h1>Gestion Spécialités</h1>

<ul>
<?php foreach($specialties as $specialty): ?>
    <li>
        <?= $specialty['name'] ?>
    </li>
<?php endforeach; ?>
</ul>
<h1>Gestion Médecins</h1>

<table border="1">

<tr>
    <th>Nom</th>
    <th>Email</th>
    <th>Spécialité</th>
</tr>

<?php foreach($doctors as $doctor): ?>

<tr>
    <td>
        <?= $doctor['first_name'] ?>
        <?= $doctor['last_name'] ?>
    </td>

    <td>
        <?= $doctor['email'] ?>
    </td>

    <td>
        <?= $doctor['specialty'] ?>
    </td>
</tr>

<?php endforeach; ?>

</table>
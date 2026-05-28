<?php
include "../lib/conex.php"; 
include "../lib/Item.php"; // Clase genérica (puede ser Evento, Curso, Producto)

$modulo = "Eventos"; // Cambiar a "Cursos" o "Productos" según examen

$db = new Conex();
$con = $db->conectar();

$item = new Item($con, $modulo); // Clase recibe el módulo
$rs = $item->getALL();
?>

<?php include_once '../partials/template_start.php'; ?>

<h3><?php echo "Gestión de $modulo"; ?></h3>

<?php 
if (isset($_GET['ok'])) {
    if ($_GET['ok'] == 1) echo "<div class='alert alert-success'>$modulo insertado correctamente ✅</div>";
    if ($_GET['ok'] == 2) echo "<div class='alert alert-success'>$modulo actualizado correctamente ✅</div>";
    if ($_GET['ok'] == 3) echo "<div class='alert alert-success'>$modulo eliminado correctamente ✅</div>";
}
if (isset($_GET['error']) && $_GET['error'] == 3) {
    echo "<div class='alert alert-danger'>❌ Error al eliminar el $modulo.</div>";
}
?>

<table class="table table-striped">
<tr>
    <th>ID</th>
    <th><?php echo ($modulo=="Eventos")?"Título":"Nombre"; ?></th>
    <?php if ($modulo=="Eventos"): ?>
        <th>Lugar</th>
        <th>Fecha</th>
        <th>Hora</th>
    <?php elseif ($modulo=="Cursos"): ?>
        <th>Descripción</th>
        <th>Fecha inicio</th>
    <?php elseif ($modulo=="Productos"): ?>
        <th>Descripción</th>
        <th>Precio</th>
    <?php endif; ?>
    <th>Activo</th>
    <th><a href="nuevo.php" class="btn btn-outline-primary">Nuevo</a></th>
    <th><a href="api.php" class="btn btn-outline-info">JSON</a></th>
</tr>

<?php 
while ($fila = $rs->fetch_assoc()) { ?>
<tr>
    <td><?php echo $fila["id"]; ?></td>
    <td><?php echo $fila["titulo"] ?? $fila["nombre"]; ?></td>

    <?php if ($modulo=="Eventos"): ?>
        <td><?php echo $fila["lugar"]; ?></td>
        <td><?php echo $fila["fecha"]; ?></td>
        <td><?php echo $fila["hora"]; ?></td>
    <?php elseif ($modulo=="Cursos"): ?>
        <td><?php echo $fila["descripcion"]; ?></td>
        <td><?php echo $fila["fecha_inicio"]; ?></td>
    <?php elseif ($modulo=="Productos"): ?>
        <td><?php echo $fila["descripcion"]; ?></td>
        <td><?php echo $fila["precio"]; ?></td>
    <?php endif; ?>

    <td><?php echo ($fila["activo"]) ? "Sí" : "No"; ?></td>
    <td><a href="editar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-warning">Editar</a></td>
    <td><a href="borrar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-danger">Borrar</a></td>
    <td><a href="api.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-info" target="_blank">JSON</a></td>
    <?php if ($modulo=="Eventos"): ?>
        <td><a href="../inscriptos/index.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-secondary">Inscriptos</a></td>
    <?php endif; ?>
</tr>
<?php } ?>
</table>

<?php include_once '../partials/template_end.php'; ?>

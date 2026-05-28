<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de <?php echo $modulo; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php
// Definir el módulo actual (puede ser "Eventos", "Cursos", "Productos")
$modulo = "Eventos"; 
$titulo_form = "Gestión de $modulo";

// Definir target genérico
$target = "guardar.php";
?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h2 class="mb-0"><?php echo $titulo_form; ?></h2>
    </div>
    <div class="card-body">

      <?php 
      if (isset($_GET['error']) && $_GET['error'] == 1) {
          echo "<div class='alert alert-danger'>❌ Error al procesar el $modulo.</div>";
      }
      ?>

      <form action="<?php echo $target; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

        <!-- Campo nombre/título -->
        <div class="mb-3">
          <label for="nombre" class="form-label">
            <?php echo ($modulo == "Eventos") ? "Título" : "Nombre"; ?>
          </label>
          <input type="text" value="<?php echo $fila['titulo'] ?? $fila['nombre']; ?>" 
                 id="nombre" name="nombre" maxlength="100" required class="form-control">
        </div>

        <!-- Campo fecha (solo para eventos/cursos) -->
        <?php if ($modulo != "Productos"): ?>
        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha</label>
          <input type="date" value="<?php echo $fila['fecha'] ?? ''; ?>" 
                 id="fecha" name="fecha" class="form-control">
        </div>
        <?php endif; ?>

        <!-- Campo hora (solo para eventos) -->
        <?php if ($modulo == "Eventos"): ?>
        <div class="mb-3">
          <label for="hora" class="form-label">Hora</label>
          <input type="time" value="<?php echo $fila['hora'] ?? ''; ?>" 
                 id="hora" name="hora" class="form-control">
        </div>
        <?php endif; ?>

        <!-- Campo descripción/lugar -->
        <div class="mb-3">
          <label for="descripcion" class="form-label">
            <?php echo ($modulo == "Eventos") ? "Lugar" : "Descripción"; ?>
          </label>
          <input type="text" value="<?php echo $fila['lugar'] ?? $fila['descripcion']; ?>" 
                 id="descripcion" name="descripcion" maxlength="191" class="form-control">
        </div>

        <!-- Campo precio (solo para productos) -->
        <?php if ($modulo == "Productos"): ?>
        <div class="mb-3">
          <label for="precio" class="form-label">Precio</label>
          <input type="number" step="0.01" value="<?php echo $fila['precio'] ?? ''; ?>" 
                 id="precio" name="precio" class="form-control">
        </div>
        <?php endif; ?>

        <!-- Estado activo -->
        <div class="mb-3">
          <label for="activo" class="form-label">Activo</label>
          <select id="activo" name="activo" required class="form-select">
            <option value="1" <?php echo ($fila['activo'] == 1) ? "selected" : ""; ?>>Sí</option>
            <option value="0" <?php echo ($fila['activo'] == 0) ? "selected" : ""; ?>>No</option>
          </select>
        </div>

        <div class="d-flex justify-content-between">
          <a href="index.php" class="btn btn-secondary">⬅ Volver al listado</a>
          <button type="submit" class="btn btn-success">💾 Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

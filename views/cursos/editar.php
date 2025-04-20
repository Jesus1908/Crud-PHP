<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Curso</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <form id="formulario-registro" autocomplete="off">
    <div class="card mt-3">
      <div class="card-header bg-primary text-light">Actualizar curso</div>
      <div class="card-body">
        <div class="form-floating mb-2">
          <select name="idcategoria" id="idcategoria" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="1">Matematica</option>
            <option value="2">Literatura</option>
            <option value="3">Informatica</option>
          </select>
          <label for="idcategoria">Categorias</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="titulo" placeholder="Título del curso" required>
          <label for="titulo">Título</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="duracion" placeholder="Duración (HH:MM:SS)" required>
          <label for="duracion">Duración</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="nivel" placeholder="Nivel" required>
          <label for="nivel">Nivel</label>
        </div>

        <div class="form-floating mb-2">
          <input type="number" step="any" class="form-control text-end" id="precio" placeholder="Precio" required>
          <label for="precio">Precio</label>
        </div>

        <div class="form-floating mb-2">
          <input type="date" class="form-control" id="fechainicio" required>
          <label for="fechainicio">Fecha de inicio</label>
        </div>
      </div>
      <div class="card-footer text-end">
        <button class="btn btn-sm btn-primary" type="submit">Actualizar</button>
        <button class="btn btn-sm btn-secondary" type="reset">Cancelar</button>
      </div>
    </div>
  </form>

  <!-- Botón adicional centrado y separado -->
  <div class="text-center mt-4">
    <a href="../cursos/listar.php" class="btn btn-info px-4 py-2">Volver a la lista de cursos</a>
    <a href="../../public/index.html" class="btn btn-success px-4 py-2">Volver al menú principal</a>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {

    function obtenerRegistro() {
      const URL = new URLSearchParams(window.location.search);
      const id = URL.get('id');

      const parametros = new URLSearchParams();
      parametros.append("task", "getById");
      parametros.append("id", id);

      fetch(`../../app/controllers/CursoControler.php?${parametros}`, { method: 'GET' })
        .then(response => response.json())
        .then(data => {
          if (data.length > 0) {
            const curso = data[0];
            document.getElementById("idcategoria").value = curso.idcategoria;
            document.getElementById("titulo").value = curso.titulo;
            document.getElementById("duracion").value = curso.duracion;
            document.getElementById("nivel").value = curso.nivel;
            document.getElementById("precio").value = curso.precio;
            document.getElementById("fechainicio").value = curso.fechainicio;
          }
        })
        .catch(error => console.error(error));
    }

    function actualizarCurso(cursoActualizado) {
      fetch('../../app/controllers/CursoControler.php', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(cursoActualizado)
      })
      .then(response => response.json())
      .then(data => {
        if (data.filas === 1) {
          alert("Curso actualizado correctamente.");
          window.location.href = "listar.php"; 
        } else {
          alert("No se pudo actualizar el curso.");
        }
      })
      .catch(error => console.error("Error al actualizar:", error));
    }

    
    document.getElementById("formulario-registro").addEventListener("submit", function(e) {
      e.preventDefault();

      const URL = new URLSearchParams(window.location.search);
      const id = URL.get('id');

      const cursoActualizado = {
        idcurso: id,
        idcategoria: document.getElementById("idcategoria").value,
        titulo: document.getElementById("titulo").value,
        duracion: document.getElementById("duracion").value,
        nivel: document.getElementById("nivel").value,
        precio: document.getElementById("precio").value,
        fechainicio: document.getElementById("fechainicio").value
      };

      actualizarCurso(cursoActualizado);
    });

    obtenerRegistro();
  });
</script>

</body>
</html>


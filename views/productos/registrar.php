<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
  
  <div class="container">

    <form action="" autocomplete="off" id="formulario-registro">
      <div class="card mt-3">
        <div class="card-header bg-primary text-light">Registro de Cursos</div>
        <div class="card-body">
          
          <div class="form-floating mb-2">
            <select name="categorias" id="categorias" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="1">Matematica</option>
              <option value="2">Literatura</option>
              <option value="3">Informatica</option>
            </select>
            <label for="categorias">Categorias</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="titulo" placeholder="Titulo" required>
            <label for="titulo">Titulo</label>
          </div>

          <div class="form-floating mb-2">
            <input type="time" class="form-control" id="duracion" placeholder="Duracion" required>
            <label for="duracion">Duracion</label>
          </div>

          <!-- Compartir fila -->
          <div class="row g-2">

            <div class="col">
              <div class="form-floating mb-2">
                <input type="text" class="form-control text-end" id="nivel" placeholder="Nivel" required>
                <label for="Nivel">Nivel</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating mb-2">
                <input type="number" value="6" min="0" step="10" class="form-control text-end" id="precio" placeholder="Precio" required>
                <label for="precio">Precio</label>
              </div>
            </div>

          </div>
          <!-- Fin compartir fila -->

          <div class="form-floating">
            <input type="date" class="form-control" id="fechainicio" name="fechainicio" required>
            <label for="fechainicio">Fecha Inicio</label>
          </div>


        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
          <button class="btn btn-sm btn-secondary" type="reset">Cancelar</button>
        </div>
      </div> <!-- ./card -->
    </form>

  </div> <!-- ./container -->

  <script>
    const formulario = document.querySelector("#formulario-registro");

    function registrarCurso() {
        fetch(`../../app/controllers/CursoControler.php`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            idcategoria : document.querySelector("#categorias").value,
            titulo      : document.querySelector("#titulo").value,
            duracion    : document.querySelector("#duracion").value,
            nivel       : document.querySelector("#nivel").value,
            precio      : parseFloat(document.querySelector("#precio").value),
            fechainicio : document.querySelector("#fechainicio").value
          })
        })
         .then(response => response.json())
         .then(data => {
           if (data.filas > 0) {
             formulario.reset();
             alert("Guardado correctamente");
            }
        })
         .catch(error => {
        console.error(error);
        });
    }

    formulario.addEventListener("submit", function (event) {
        event.preventDefault();
        if (confirm("¿Está seguro de registrar?")) {
        registrarCurso();
        }
    });
  </script>
    
</body>
</html>

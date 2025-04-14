USE Cursos;

SELECT * FROM categorias;

CALL spu_cursos_registrar( --Procedimiento almacenado para registrar cursos
    2,                          
    'Análisis Literario',      
    '02:00:00',                
    'Intermedio',              
    55.00,                     
    '2025-08-01'               
);

SELECT * FROM cursos;

CALL spu_cursos_filtrar_por_categoria(2); --Llamada al procedimiento almacenado para filtrar cursos por su categoria

SELECT * FROM vista_cursos_todos; 


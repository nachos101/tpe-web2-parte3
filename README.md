# tpe-web2-parte3
# tpe-web2
GRUPO 3  
Straubinger, Diego Ignacio - nachostrau17@gmail.com  
Niyen, Sofia Aylen - sniyen@alumnos.exa.unicen.edu.ar  

Tematica: Plataforma de streaming.  
En esta plataforma el usuario podra ver un catalogo de series, cada una con sus respectivas temporadas y cantidad de capitulos.

![diagrama_entidad_relaciones.png](/diagrama_entidad_relaciones.png)


# Obtener todas las series GET

## Endpoint: `/api/series/`

| Parámetros       | Tipo   | Valores                                                                 | Descripción                                                                 | Ejemplo |
|------------------|--------|-------------------------------------------------------------------------|-----------------------------------------------------------------------------|---------|
| `atributo, orden`| string | `atributo` = titulo, genero, cant_temporadas, fecha_estreno<br>`orden` = DESC, ASC    | Ordena resultados por campo y dirección                                     | `/api/series/?atributo=titulo&orden=DESC` |
| `atributo`  | string |  | Filtra resultados por campo y valor específico                              | `/api/series/?genero=Comedia` |
| `page, limit`    | number | `page` = 1,2,3...<br>`limit` = 1,2,3...                                 | Paginación y límite de resultados por página                                | `/api/series/?page=2&limit=3` |

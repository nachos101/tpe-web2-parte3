# tpe-web2-parte3
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
| `titulo`  | string | Heartstopper, Glow up, Reclutas, The Office, Un amor predestinado | Filtra resultados por campo y valor específico | `/api/series/?titulo=Reclutas` |
| `genero` | string | Comedia, Drama, Infatil, Reality, Romance | Filtra resultados por campo y valor específico | `/api/series/?genero=Comedia` |
| `cant_temporadas` | string | 1,2,3,4,5... | Filtra resultados por campo y valor específico | `/api/series/?cant_temporadas=2` |
| `page, limit`    | number | `page` = 1,2,3...<br>`limit` = 1,2,3...                                 | Paginación y límite de resultados por página                                | `/api/series/?page=2&limit=3` |

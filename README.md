# tpe-web2-parte3
GRUPO 3  
Straubinger, Diego Ignacio - nachostrau17@gmail.com  
Niyen, Sofia Aylen - sniyen@alumnos.exa.unicen.edu.ar  

Tematica: Plataforma de streaming.  
En esta plataforma el usuario podra ver un catalogo de series, cada una con sus respectivas temporadas y cantidad de capitulos.

![diagrama_entidad_relaciones.png](/diagrama_entidad_relaciones.png)


## Obtener todas las series GET
# Endpoint: `/api/series/`

| Parámetros       | Tipo   | Valores                                                                 | Descripción                                                                 | Ejemplo |
|------------------|--------|-------------------------------------------------------------------------|-----------------------------------------------------------------------------|---------|
| `atributo, orden`| string | `atributo` = titulo, genero, cant_temporadas, fecha_estreno<br>`orden` = DESC, ASC    | Ordena resultados por campo y dirección                                     | `/api/series/?atributo=titulo&orden=DESC` |
| `titulo`  | string | Heartstopper, Glow up, Reclutas, The Office, Un amor predestinado | Filtra resultados por campo y valor específico | `/api/series/?titulo=Reclutas` |
| `genero` | string | Comedia, Drama, Infatil, Reality, Romance | Filtra resultados por campo y valor específico | `/api/series/?genero=Comedia` |
| `clasificacion` | string | 14... | Filtra resultados por campo y valor específico | `/api/series/?clasificacion=14` |
| `page, limit`    | number | `page` = 1,2,3...<br>`limit` = 1,2,3...                                 | Paginación y límite de resultados por página                                | `/api/series/?page=2&limit=3` |
## Obtener una serie GET
# Endpoint: `/api/series/:id`
| Parámetros       | Tipo   | Descripción                                                                 | 
|------------------|--------|-----------------------------------------------------------------------------|
| `id` | string | id de la serie a fetchear |

## Agregar una serie `POST`
# Endpoint: `/api/series/`
| Parámetros       | Tipo   | Descripción                                                                 | 
|------------------|--------|-----------------------------------------------------------------------------|
| `id` | string | id de la serie a agregar |

# Ejemplo de body
```json
{
"titulo":"The Office",
"genero":"Romance",
"cant_temporadas":7,
"sinopsis":"AAAAAA",
"clasificación":12,
"fecha_estreno":"2006-09-10",
"img":"https:\/\/www.google.com\/url?sa=i&url=https%3A%2F%2Fplay.mercadolibre.com.ar%2Fver%2Fthe-office%2F448af4eee6f24a50ae89d197e04cd0b0&psig=AOvVaw36kh9WT0uSu2d2eCWKdrUO&ust=1763040361936000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCKDglabb7JADFQAAAAAdAAAAABAE"}
```

## Editar una serie `PUT`
# Endpoint: `/api/series/:id`
| Parámetros       | Tipo   | Descripción                                                                 | 
|------------------|--------|-----------------------------------------------------------------------------|
| `id` | string | id de la serie a editar |

## Obtener token `GET`
# Endpoint: `/api/auth/login`
| Parámetros       | Tipo   | Valores                                                                 | Descripción                                                                 |
| -----------------|--------|-------------------------------------------------------------------------|-----------------------------------------------------------------------------|
| `username`       | string | webadmin                                                                | nombre de usuario                                                           |
| `password`       | string | admin                                                                   | contraseña                                                                  |

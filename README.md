## API REST para un showroom de indumentaria
- Para su funcionamiento importar la BASE DE DATOS: database/db_showroom.sql
- Para usarla en postman http://localhost/web2/tpe2API/api/cliente
- Ejemplos de uso:
    - [GET] .../api/cliente (accede a un listado de todos los clientes)
    - [GET] .../api/cliente/2 (accede al cliente con id 2)
    - [POST] .../api/cliente (lee el contenido del body y agrega un nuevo cliente)
    - [PUT] .../api/cliente/5 (lee el contenido del body y edita los datos del cliente seleccionado)
    - [DELETE] .../api/cliente/7 (borra al cliente con el id 7)

- Para hacer un POST o un PUT se deben ingresar los datos con el siguiente formato:
    - {
            "nombre": "Arispe",
            "apellido": "Florencia",
            "dni": "38824535",
            "email": "florenciaarispe98@gmail.com"
    }

- Otras herramientas:
    - Ascendentemente: .../api/cliente?sort=nombre&order=asc (Ordena los nombres ascendentemente)
    - Descendentemente: .../api/cliente?sort=apellido&order=desc (Ordena los apellidos descendentemente)
    - Filtro: .../api/cliente?filtername=florencia (Muestra solo las columnas que tengan el nombre florencia)
    - Paginacion:.../api/cliente?page=2&limit=1 (Muestra 1 elemento (limit) de la pagina 2 (page))

## Requerimientons funcionales

    - La API Rest debe ser RESTful
    
    - Debe tener al menos un servicio que liste (GET) una colección entera de entidades. Debe poder ordenarse opcionalmente por al menos un campo de la tabla, de manera ascendente o descendente.

    - Debe tener al menos un servicio que obtenga (GET) una entidad determinada por su ID.
    
    - Debe tener al menos un servicio para agregar o modificar datos (POST o PUT)
    
    - La API Rest debe manejar de manera adecuada al menos los siguientes códigos de error (200, 201, 400 y 404)
    
    - El servicio que obtiene una colección entera debe poder paginarse.
    
    - El servicio que obtiene una colección entera debe poder filtrarse por alguno de sus campos.

# Proveedores

Nuestro departamento de contabilidad necesita poder introducir en nuestro sistema los datos de los proveedores con los que trabajamos habitualmente, así que nos han solicitado una aplicación que les permita hacerlo de forma rápida y sencilla.

## Datos

Los datos que necesitaremos guardar de cada proveedor serán los siguientes:

- Nombre
- Correo electrónico
- Teléfono de contacto
- Tipo de proveedor, en nuestro caso podrán ser de hotel, pista o complemento.
- Si están activos o no

Además, sería interesante tener constancia de cuándo se ha introducido este proveedor en el sistema, así como cuándo se ha actualizado su información por última vez.

## Aplicación

Necesitaremos que nuestro departamento de contabilidad pueda:

- Crear un nuevo proveedor
- Editar un proveedor
- Eliminar un proveedor
- Visualizar el listado completo de proveedores que tenemos en el sistema

<hr>

## Diario

### Dia 1 (jueves tarde):
- Abro el pdf de la prueba y leo que tengo que usar Symfony 4
- Entro en incertidumbre porque no sé si el número 4 es un 'must' o es solo porque el pdf no se había actualizado..o porque es la versión que usan allí
- Me debato entre la duda de si podré tirar millas con una versión más reciente y por tanto ya compatible con PHP 8
- Y como no me gustan las dudas, lo pregunto por email y me aclaran que puedo usar versiones más recientes, así que opto por la ^4.4.0 que es la última versión de la serie 4.x con soporte a largo plazo (LTS) y que incluye compatibilidad con PHP 8
- Y todo empieza a fluir 😁
### Dia 2 (viernes):
- Documentación en mano, inicio la curva del aprendizaje de información nueva
- Voy descubriendo las 7 diferencias entre Laravel y Symfony...y me sorprende acabar descubriendo que Symfony es el padre de Laravel
- Momento ¡wOw!...¿En serio? Y que creía que eran 'primos hermanos'...
![El padre de Laravel](https://i.blogs.es/f8be48/daily-life-of-darth-vader-2/1366_2000.jpg)
- Me planteo haber vivido engañada toda mi vida, pero me siento feliz de saberlo y me pongo ¡manos a la obra! 📌
- ⏰ Tic-tac tic-tac... 1er Controller, 1eras vistas, consigo listar los primeros registros de la Base de datos..
- Decido instalar el paquete zenstruck/foundry para tener 1 Factory para los datos de prueba
### Dia 3 (sábado):
- No he tirado la toalla; de hecho se ha convertido en el reto personal del fín de semana >.<
- Soy consciente de que el tipo de proveedor podría ser una tabla aparte, pero como estoy tirando hacia un MPV de momento lo establezco como una especie de SET en la misma entidad 'proveedor'
- Bueno, bueno, ya queda poco para terminar..
- Sigo pensando que he hecho una 'chapuzilla' incluyendo el tipo de proveedor en la tabla proveedor; si me quedara tiempo quizás lo reviso pero prefiero enfocarme al despliegue con docker
### Dia 4 (domingo) -> 💀El Deadline:
- Hoy estoy con la configuración del despliegue con dcker; escojo la imagen de mariadb para que cubra la compatibilidad con macOS
- Creo las imágenes, cargo los contenedores, pero aun así parece que hay un problema de conexión a la BBDD..
- Ya no me queda mucho tiempo, así que es posible que lo deje así
- Volviendo a la aplicación; soy consciente que me quedó la validación de tipos de datos en la parte del backend, para el formulario de crear y el de modificar. Vi que hay 3 formas de hacer formularios en Symfony, y yo me decanté por la menos nativa (la de hacer el form con html). Al no tener las validaciones automáticas, necesitaría más tiempo para ver si puedo replicar una especie de clase tipo Request-validation como se hace en Laravel; esto o aprender las 2 otras formas de creación de formularios, pero tampoco me queda mucho tiempo más

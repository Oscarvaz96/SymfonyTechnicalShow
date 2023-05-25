# SymfonyTechnicalShow
En esta pequeña aplicación muestro una implementación básica de un diseño DDD y una Api Gateway para redigirir peticiones a otro microservicio

# Domain Driven Design
En src\Controller\ProductController.php hago una pequeña implementación básica, de un Servicio que utiliza algunos conceptos de domain driven design.
Como los Application Services y los Domain Services (RegisterProductRequest y RegisterProductResponse)
# API Gateway
En src\Service\CatalogService.php creo un servicio que extiende de una clase tipo Api Gateway sencilla.
Donde tengo únicamente peticiones HTTP. No hay Service Registry ni Health Check, solo peticiones.
Es un principio de como se utilizan los Microservicios.



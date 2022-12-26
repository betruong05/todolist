**1. Create environment**

Build docker images.

```sh
$ docker-compose build
```
##### Note: If you want to build with other params you can check more detail with:
```sh
$ docker-compose build --help
```
  
Run the application in background mode with:

```sh
$ docker-compose up -d
```

**2. Install dependencies**

```sh
$ composer install
```
    
**3. Dump autoload**
    
```sh
$ composer dump-autoload
```

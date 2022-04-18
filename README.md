<h1 align="center">Welcome to friends-enem-app 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/php-8.0-blue.svg?cacheSeconds=2592000" />
  <img alt="Version" src="https://img.shields.io/badge/laravel-9.0-red.svg?cacheSeconds=2592000" />
  <a href="https://github.com/edvaldotorres/friends-enem-app#readme" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="#" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
</p>

> The project refers to a system of teachers and students who volunteer for pre-enem classes. The technical part of the project follows the MVC standard and good code practices such as SOLID, Object Orientation and Clean CODE.

### 🏠 [Homepage](https://github.com/edvaldotorres/friends-enem-app#readme)

## Prerequisites

* Docker

## Install

1. Clone your repository, example:

```sh
git clone https://github.com/edvaldotorres/friends-enem-app
```
2. Change directory into the newly created app/project.

```sh
cd friends-enem-app
```
3. Install all required dependencies

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
NOTE: This may take a while if this is the first time installing this as a container.

4. Set the proper permissions to the project files.

```sh
sudo chown -R $USER: .
```
5. Run the servers with Sail

```sh
sail up -d
```
6. Create a database to be used by this project

> #mysql --password=  --execute='create database friends_enem_app'
> #exit

7. Copy .env File

```sh
cp .env.example .env
```
8. Open .env to match the following line:

> FROM: DB_HOST=127.0.0.1
  TO: DB_HOST=mysql

9. Generate APP_KEY Key.

```sh
sail artisan key:generate
```
10. Build the seed.

```sh
sail artisan migrate:fresh --seed
```
## Usage

1. You can now open your application with your browser: http://localhost

> E-mail: admin@admin.com.br
> Senha: 123Admin@admin
## Author

👤 **Edvaldo Torres de Souza**

* Website: [edvaldotorres.com.br](https://edvaldotorres.com.br/)
* Github: [@edvaldotorres](https://github.com/edvaldotorres)
* LinkedIn: [Edvaldo Torres](https://www.linkedin.com/in/edvaldo-torres-189894150/)

## 🤝 Contributing

Contributions, issues and feature requests are welcome!<br />Feel free to check [issues page](https://github.com/edvaldotorres/friends-enem-app/issues). 

## Show your support

Give a ⭐️ if this project helped you!

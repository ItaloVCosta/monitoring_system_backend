
# Monitoring System Backend

This repository contains the backend source code for the **Monitoring System** project, developed to monitor and manage server resources. It is designed to run inside Docker containers, ensuring quick and easy installation in any environment.

## Prerequisites

Before you begin, make sure you have [Docker](https://docs.docker.com/get-docker/) and [Docker Compose](https://docs.docker.com/compose/install/) installed on your system.

## Project Setup

Follow the steps below to set up and run the project.

### 1. Clone the Repository

```bash
git clone https://github.com/ItaloVCosta/monitoring_system_frontend.git
```

### 2. Start Containers with Docker Compose

To build and start the containers, run the command below. It will set up the development environment with all the necessary services:

```bash
docker-compose up --build
```

> **Note:** The `--build` parameter is used to ensure that all changes are reflected in the containers when they are started.

### 3. Install Composer Dependencies

After the containers are up and running, open a new terminal and run the `composer install` command inside the PHP container:

```bash
docker-compose exec php_server composer install
```

This command will install all the necessary dependencies for the project. If this doesn't work, try run direct inside the container the:

```bash
composer install
```

### 4. The Project is Ready!

With the above steps completed, the backend is ready to receive requests. The default API URL is: [http://localhost:8000](http://localhost:8000). Make sure to add the `.env` file with the proper environment variables.

To verify that the project is working correctly, you can access the configured address in your browser or test one of the routes using an HTTP client like [Postman](https://www.postman.com/).
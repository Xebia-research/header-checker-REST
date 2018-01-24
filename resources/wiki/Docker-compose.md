# Docker

## Installation Docker

Install docker:
> https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/#install-using-the-repository

Install docker-compose:
> https://docs.docker.com/compose/install/#install-compose
***

## Setup host environment

Databases and configuration files are mapped to the host machine.

### Choose a directory and clone the project.
> git clone https://github.com/xebia-research/header-checker-REST.git

## Docker-compose

### Change the .env.example.yml to .env
> mv -f .env.example.yml .env

### Run docker-compose pull
> docker-compose pull

### Start docker containers
> docker-compose up -d



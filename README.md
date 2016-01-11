Your X Slack Bot
================

# About

This is a Slack Bot to engage users of a given Slack channel into random discussion. It picks a random user out of the Slack team members and mentions him in a given channel with a random message.

# Requirements

Basically, you need to have [Docker Toolbox installed](https://www.docker.com/docker-toolbox)

# How to use it?

## Start the environment

In the project root directory run the following command:

```
docker-compose up -d
```

This command will build `web` Docker image and run it a container with that image.

## Get into the container

You can log into the container by typing:

```
docker-compose run web bash
```

Now you wil be signed into the container and in the project root directory.

## Install dependencies

In order to install the required dependencies, while in the container type:

```
composer install -n
```

# Run the Bot

## Testing

To test the bot, while inside the container, run the command:

```
php app/console poke:user bot-sandbox --test
```

This will post the message into the `#bot-sandbox` channel and only mentioning the test users

## Production

In order to run the real bot run

```
php app/console poke:user xhq
```

This will pick a random user and mention him on `#xhq` channel

# Contributing

## CI

In order to run tests pleas type inside the container:

```
./bin/phpspec run
```

## Notification service

Microservice for sending SMS and E-Mail notifications.

## How it works

This microservice read queue from RabbitMQ (you can try to use any other driver that implements QueueAPI) and sending SMS or mail.

Example queue message for mail:

```
{
    'type': 'mail',
    'data': {
        'content': 'Test mail',
        'to': 'test@example.com',
        'subject': 'Test E-Mail',
    },
}
```

Example queue message for SMS:

```
{
    'type': 'sms',
    'data': {
        'message': 'Test sms message',
        'phones': '79999999999, 79999999998',
    },
}
```

For sending test SMS message into queue you can use:

```
php artisan notification:test-sms-push
```

And for mail:

```
php artisan notification:test-mail-push
```

## How to deploy using Docker Compose

Run this in root directory:

```
cd docker/local
./build.sh
docker-compose up -d
```

## How to deploy using Minikube

Run this in root directory:

```
docker build -f docker/prod/Dockerfile -t notification-service:latest .
minikube start
minikube cache add notification-service:latest
cd docker/prod
kubectl apply -f deployment.yaml
```

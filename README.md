## Сервис нотификаций

Микросервис для отправки SMS и E-Mail нотификаций.

## Как работает

Данный микросервис читает очередь в RabbitMQ, указанную в environment, и в зависимости от типа подготавливает и отправляет либо смс, либо почтовое уведомление.

Пример сообщения в очереди на отправку письма:

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

Пример сообщения в очереди на отправку SMS:

```
{
    'type': 'sms',
    'data': {
        'message': 'Test sms message',
        'phones': '79999999999, 79999999998',
    },
}
```

Для отправки тестового СМС сообщения в очередь можно использовать:

```
php artisan notification:test-sms-push
```

Для письма:

```
php artisan notification:test-mail-push
```

## Как развернуть в Docker Compose

В корне сервиса:

```
cd docker/local
./build.sh
docker-compose up -d
```

## Как развернуть в Minikube

В корне сервиса:

```
docker build -f docker/prod/Dockerfile -t notification-service:latest .
minikube start
minikube cache add notification-service:latest
cd docker/prod
kubectl apply -f deployment.yaml
```

Тестовое задание для вакансии artsofte

Для запуска понадобится Docker, вот конкретная инструкция:
1. Разверните окружение, введя команду ```sudo docker-compose up -d```
2. Установите пакеты composer командой ```sudo docker exec -ti car_loan_php composer install```
3. Примените миграции командой ```sudo docker exec -ti car_loan_php bin/console d:m:m```
4. Примените фикстуры командой ```sudo docker exec -ti car_loan_php bin/console doctrine:fixtures:load```

Готово!

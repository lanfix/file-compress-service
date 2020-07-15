Project X
==================================

Разворачиваем среду
----------------------------------

Первое что нужно сделать - поставить docker-ce
```
sudo apt remove -y docker docker-engine docker.io
sudo apt install -y apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt update
sudo apt install docker-ce -y
sudo usermod -aG docker ИмяВашегоПользователя
sudo systemctl restart docker
```
Перелогиниваемся под ``` ИмяВашегоПользователя ``` или ``` reboot ```  
Далее ставим docker-compose
```
sudo curl -L https://github.com/docker/compose/releases/download/1.23.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose && sudo chmod +x /usr/local/bin/docker-compose
```
Для рыботы также потребуется утилита ``` make ```, поэтому ставим
```
sudo apt install make
```
Также для сборки требуется php. Подойдет любая более-менее актуальная версия
```
sudo apt install php
```

Запуск среды
----------------------------------

Данная команда запустит все нужные docker контейнеры (требуется выполнять ее каждый раз
после включения машины, т.к. по умолчанию ни один контейнер не запущен)
```
make up
```

Сборка проекта
----------------------------------

Когда все контейнеры запустятся, можно будет производить сборку проекта следующей командой.
Она установит зависимости composer`а, подключит нужную конфигурацию и накатит миграции
```
make build
```
На этом установка заканчивается. Можно воркать! Если что-то зависнет - юзай
``` make restart ```. Она выполнит перезапуск всех контейнеров.


База данных
----------------------------------
Подключиться к БД из шторма можно по данному адресу
```
jdbc:mysql://localhost:3306
```

Список дополнительных команд
----------------------------------

Рестарт всех контейнеров
```
make restart
```
Остановить все контейнеры
```
make down
```
Скачать/обносить зависимости composer
```
make composer
```
Применить миграции
```
make migrate
```
Создать новый файл миграции
```
make migrate-create NAME=имяНовойМиграции
```
Откатить последние миграции (если не указывать количество - откатится самая последняя)
```
make migrate-down
make migrate-down AMOUNT=3
```
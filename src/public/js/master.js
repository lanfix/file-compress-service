$(function () {

    let terminal = $('.main-terminal');
    let typeItOptions = {speed: 50, autoStart: true, cursor: false};

    /**
     * Организуем синхронную работу
     */
    let wait = function(first) {
        return new(function(){
            let self = this;
            let callback = function() {
                let args;
                if(self.deferred.length) {
                    args = [].slice.call(arguments);
                    args.unshift(callback);
                    self.deferred[0].apply(self, args);
                    self.deferred.shift();
                }
            };
            this.wait = function(run) {
                this.deferred.push(run);
                return self;
            };
            this.deferred = [];
            first(callback);
        });
    };

    /**
     * Мигание курсора
     */
    setInterval(function () {
        $('.terminal-cursor').toggle();
    }, 500);

    /**
     * Шаблон строки в терминале
     */
    let lineTemplate = $(`<div class="terminal-line"><span class="line-prefix"></span><span class="line-text"></span></div>`);

    /**
     * Функция переключения курсора
     */
    function switchCursor(line)
    {
        let cursor = $('.terminal-cursor');
        if (!cursor.length) {
            cursor = $(`<span class="terminal-cursor">_</span>`);
        }
        line.append(cursor);
    }

    /**
     * Эмуляция пользовательского ввода
     */
    function userInput(prefix, input)
    {
        let currentLine = lineTemplate.clone();
        let currentLinePrefix = currentLine.children('.line-prefix');
        let currentLineText = currentLine.children('.line-text');
        switchCursor(currentLine);
        currentLinePrefix.text(prefix);
        terminal.append(currentLine);
        currentLineText.typeIt(typeItOptions).tiType(input);
    }

    /**
     * Напечатать информацию
     */
    function printString(prefix, input, delay = 0)
    {
        let currentLine = lineTemplate.clone();
        let currentLinePrefix = currentLine.children('.line-prefix');
        let currentLineText = currentLine.children('.line-text');
        terminal.append(currentLine);
        switchCursor(currentLine);
        setTimeout(function () {
            currentLinePrefix.text(prefix);
            currentLineText.text(input);
        }, delay);
    }

    wait(function (runNext) {
        userInput('login as: ', 'root');
        setTimeout(function () {runNext();}, 800);
    }).wait(function (runNext) {
        userInput('root@localhost\'s password: ', 'qwerty123_prod');
        setTimeout(function () {runNext();}, 1000);
    }).wait(function (runNext) {
        printString('', 'Send automatic password', 1500);
        setTimeout(function () {runNext();}, 1500);
    }).wait(function (runNext) {
        printString('', 'Welcome to Ubuntu 20.04 LTS (GNU/Linux 5.4.0-37-generic x86_64)', 100);
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        printString('', '');
        printString('* ', 'Documentation: https://help.ubuntu.com');
        printString('* ', 'Management: https://landscape.canonical.com');
        printString('* ', 'Support: https://ubuntu.com/advantage');
        printString('', '');
        printString('* ', '"If you\'ve been waiting for the perfect Kubernetes dev solution for macOS, the wait is over. Learn how to install Microk8s on macOS."');
        printString('', '');
        printString('', 'Last login: Tue Jul 14 07:42:52 2020 from 127.0.0.1');
        setTimeout(function () {runNext();}, 200);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '', 100);
        setTimeout(function () {runNext();}, 800);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        userInput('root@localhost:/root# ', 'wtf');
        setTimeout(function () {runNext();}, 700);
    }).wait(function (runNext) {
        printString('-bash: ', 'команда не найдена');
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 1500);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 300);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 200);
    }).wait(function (runNext) {
        printString('root@localhost:/root# ', '');
        setTimeout(function () {runNext();}, 100);
    }).wait(function (runNext) {
        userInput('root@localhost:/root# ', 'cd /web/app');
        setTimeout(function () {runNext();}, 1000);
    }).wait(function (runNext) {
        userInput('root@localhost:/web/app# ', 'make up');
        setTimeout(function () {runNext();}, 1800);
    }).wait(function (runNext) {
        printString('', 'docker-compose up -d', 100);
        setTimeout(function () {runNext();}, 800);
    }).wait(function (runNext) {
        printString('', 'Creating my-app-php-fpm ... done', 100);
        setTimeout(function () {runNext();}, 500);
    }).wait(function (runNext) {
        printString('', 'Creating my-app-percona ... done', 100);
        setTimeout(function () {runNext();}, 1200);
    }).wait(function (runNext) {
        printString('', 'Creating my-app-nginx ... done', 100);
        setTimeout(function () {runNext();}, 700);
    }).wait(function (runNext) {
        printString('root@localhost:/web/app# ', '');
        setTimeout(function () {runNext();}, 1000);
    }).wait(function (runNext) {
        printString('root@localhost:/web/app# ', '');
        setTimeout(function () {runNext();}, 2000);
    }).wait(function (runNext) {
        userInput('root@localhost:/web/app# ', 'Wake up, {username}...');
    });

});
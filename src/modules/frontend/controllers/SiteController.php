<?php

namespace app\modules\frontend\controllers;

use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use app\models\ImageFormat;
use yii\web\HttpException;
use yii\web\Response;
use ImagickException;
use Imagick;
use Yii;

class SiteController extends BaseController
{

    /**
     * @return string
     */
    public function actionWelcome()
    {
        $imagesList = [];
        $galleryDir = Yii::getAlias('@app/public/gallery');
        if ($dir = opendir($galleryDir)) {
            while (($file = readdir($dir)) !== false) {
                if ($file === "." || $file === "..") continue;
                $fileNameParts = explode('.', $file);
                $imagesList[] = $fileNameParts[0];
            }
            closedir($dir);
        }
        return $this->render('welcome', [
            'imagesList' => $imagesList,
        ]);
    }

    /**
     * Получить ссылку на изображение.
     * Фронтенд ничего не знает о нашем кешировании. Он просто запрашивает нужный урл.
     * @param string $name Имя файла
     * @param string $size Код размера изображения (big, med, min...)
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws ImagickException
     */
    public function actionGetFileLink($name, $size)
    {
        /**
         * Валидация входных данных.
         * Имя файла не должно содержать ничего кроме букв, цифр и _
         * Код размера ищется в базе. При отсутствии - ошибка
         */
        if (!preg_match('/^[\w]+$/i', $name)) {
            throw new BadRequestHttpException('Имя файла содержит недопустимые символы');
        }
        if (!$format = ImageFormat::findOne($size)) {
            throw new BadRequestHttpException('Недопустимый размер изображения');
        }
        /**
         * Если закэшированный файл уже имеется - отдаем его.
         * Если его еще нет в кэше - начинаем генерацию.
         */
        $cachedFilePath = Yii::getAlias('@app/public/cache/' . $name . '_' . $size . '.jpg');
        if (file_exists($cachedFilePath)) {
            /**
             * Отправляем данные с нужными заголовками, чтобы
             * браузер понял что это картинка.
             */
            $this->renderJpeg(file_get_contents($cachedFilePath));
        }
        /**
         * Если нет оригинального файла, то отдаем 404 ошибку
         */
        $originalFilePath = Yii::getAlias('@app/public/gallery/' . $name . '.jpg');
        if (!file_exists($originalFilePath)) {
            throw new NotFoundHttpException('Файл не найден');
        }
        /**
         * Ресайзим изображение до граничных размеров (применяем
         * библиотечный метод генерации миниатюр).
         */
        $resizable = new Imagick($originalFilePath);
        $resizable->thumbnailImage($format->width, $format->height, true);
        $blobContain = $resizable->getImageBlob();
        /**
         * Пишем контент в файл, а после рендерим
         * его с нужными заголовками клиенту.
         */
        file_put_contents($cachedFilePath, $blobContain);
        $this->renderJpeg($blobContain);
    }

    /**
     * Обработка ошибок
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof HttpException) {
            $code = array_flip(Response::$httpStatuses)[$exception->getName()];
            Yii::$app->response->setStatusCode($code);
        }
    }

    /**
     * Рендер jpeg изображения
     * @param string $blobContain Содержимое файла
     */
    private function renderJpeg(string $blobContain)
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('content-type','image/jpg');
        Yii::$app->response->data = $blobContain;
        Yii::$app->response->send();
    }

}
<?php

namespace Home\MediaBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderService
{
    private $webDir;
    private $defaultPath;

    public function __construct($rootDir)
    {
        $this->webDir = $rootDir . '/../web';
        $this->defaultPath = '/uploads';
    }

    public function upload(UploadedFile $file, $path = null)
    {
        $filename = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move($this->getTargetDir($path), $filename);

        return $this->getFilePath($filename, $path);
    }

    public function uploadFromBase64($base64string, $originName, $path = null)
    {
        $filename = md5(uniqid()) . '.' . $this->getFileExtension($originName);

        $file = fopen($this->getTargetDir($path) . '/' . $filename, "wb");

        $data = explode(',', $base64string);

        if (count($data) < 2) {
            throw new \Exception('Invalid file data');
        }

        fwrite($file, base64_decode($data[1]));
        fclose($file);

        return $this->getFilePath($filename, $path);
    }

    private function getTargetDir($path = null)
    {
        $targetDir = $this->webDir . $this->getWebPath($path);

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        return $targetDir;
    }

    private function getWebPath($path = null)
    {
        return $path ? $path : $this->defaultPath;
    }

    private function getFilePath($filename, $path = null)
    {
        return $this->getWebPath($path) . '/' . $filename;
    }

    private function getFileExtension($originName)
    {
        $parts = explode('.', $originName);

        if (count($parts) < 2) {
            throw new \Exception('Invalid origin filename');
        }

        return $parts[count($parts) - 1];
    }
}
<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image;

class ImageDownloader
{
    public function downloadTo(string $url, string $folder): void
    {
        $array = explode('/', $url);
        $filename = array_pop($array);

        $this->download($url, $folder.$filename);
    }

    protected function download(string $url, string $filename): void
    {
        file_put_contents($filename, fopen($url, 'r'));
    }
}

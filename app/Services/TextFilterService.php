<?php
namespace App\Services;

class TextFilterService
{
    private array $wordsArray = [];

    public function __construct()
    {
        $this->getWords();
    }

    /**
     * @return void
     */
    private function getWords(): void
    {
        $this->wordsArray = explode(',', config('services.words_filter'));
    }

    /**
     * @param $string
     * @return array
     */
    public function search($string): array
    {
        $result = [];

        if (empty($this->wordsArray)) {
            return $result;
        }

        $str = mb_strtolower($string);

        foreach ($this->wordsArray as $word) {
            if (strpos($str, $word) !== false) {
                $result[] = $word;
            }
        }

        return $result;
    }
}

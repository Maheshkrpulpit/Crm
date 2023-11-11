<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

class Language extends Model
{
    protected $fillable = ['name', 'code', 'file', 'iso_code', 'status', 'created_by'];

    use HasFactory;

    // public static function languageCodes(): array
    // {
    //     $arr = [
    //             'af' => 'Afrikaans',
    //             'sq' => 'Albanian',
    //             'am' => 'Amharic',
    //             'ar' => 'Arabic',
    //             'hy' => 'Armenian',
    //             'az' => 'Azerbaijan',
    //             'bn' => 'Bengali',
    //             'eu' => 'Basque',
    //             'be' => 'Belarusian',
    //             'bg' => 'Bulgarian',
    //             'ca' => 'Catalan',
    //             'zh' => 'Chinese',
    //             'hr' => 'Croatian',
    //             'cs' => 'Czech',
    //             'da' => 'Danish',
    //             'nl' => 'Dutch',
    //             'en' => 'English',
    //             'et' => 'Estonian',
    //             'fi' => 'Finnish',
    //             'fr' => 'French',
    //             'gl' => 'Galician',
    //             'ka' => 'Georgian',
    //             'de' => 'German',
    //             'el' => 'Greek',
    //             'gu' => 'Gujarati',
    //             'he' => 'Hebrew',
    //             'hi' => 'Hindi',
    //             'hu' => 'Hungarian',
    //             'is' => 'Icelandic',
    //             'id' => 'Indonesian',
    //             'ga' => 'Irish',
    //             'it' => 'Italian',
    //             'ja' => 'Japanese',
    //             'kk' => 'Kazakh',
    //             'ko' => 'Korean',
    //             'lv' => 'Latvian',
    //             'lt' => 'Lithuanian',
    //             'mk' => 'Macedonian',
    //             'ms' => 'Malay',
    //             'mn' => 'Mongolian',
    //             'ne' => 'Nepali',
    //             'nb' => 'Norwegian-Bokmal',
    //             'nn' => 'Norwegian-Nynorsk',
    //             'fa' => 'Persian',
    //             'pl' => 'Polish',
    //             'pt' => 'Portuguese',
    //             'ro' => 'Romanian',
    //             'ru' => 'Russian',
    //             'sr' => 'Serbian',
    //             'si' => 'Sinhala',
    //             'sk' => 'Slovak',
    //             'sl' => 'Slovenian',
    //             'es' => 'Spanish',
    //             'sw' => 'Swahili',
    //             'sv' => 'Swedish',
    //             'ta' => 'Tamil',
    //             'te' => 'Telugu',
    //             'th' => 'Thai',
    //             'tr' => 'Turkish',
    //             'uk' => 'Ukrainian',
    //             'ur' => 'Urdu',
    //             'uz' => 'Uzbek',
    //             'vi' => 'Vietnamese',
    //             'cy' => 'Welsh',
    //     ];

    //     $result = [];
    //     foreach ($arr as $key => $name) {
    //         $result[] = [
    //                 'name' => $name,
    //                 'code' => $key,
    //         ];
    //     }

    //     return $result;
    // }

    /**
     * Disable language
     *
     * @return void
     */
    public function disable(): void
    {
        $this->status = false;
        $this->save();
    }

    /**
     * Enable language
     *
     * @return void
     */
    public function enable(): void
    {
        $this->status = true;
        $this->save();
    }

    /**
     * Language folder path.
     *
     * @return string
     */
    public function languageDir(): string
    {
        return base_path('lang/' . $this->code . '/');
    }

    /**
     *get local array from file
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    public function getLocaleArrayFromFile(): mixed
    {
        return File::getRequire($this->languageDir() . 'locale.php');
    }

    /**
     * Update language file from yaml.
     *
     *
     * @param $yaml
     *
     * @return bool|int
     */
    public function updateFromYaml($yaml): bool|int
    {
        $content = '<?php return ' . var_export(Yaml::parse($yaml), true) . ';';

        return File::put($this->languageDir() . 'locale.php', $content);

    }
}

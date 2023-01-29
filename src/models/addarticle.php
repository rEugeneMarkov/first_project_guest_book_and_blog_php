<?php

namespace models;

// модель
class AddArticle extends Base
{
    /**
     * @param array<string, string> $post
     * @return array<string, string>
     */
    public static function getDataFromPost(array $post): array
    {
        $data = [];
        $data['header'] = trim($post['add_header']);
        $data['article'] = trim($post['add_article_content']);
        $data['url'] = $this->translit($data['header']);
        return $data;
    }

    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    public static function validate(array $data): array
    {
        $error = [];
        if (strlen($data['header']) <= 10) { // проверка имени
                $error['e_header'] = "Введите корректный заголовок больше 10 символов";
        } elseif (strlen($data['article']) < 200) { //проверка почты
                $error['e_article'] = "Минимальная длинна статьи 200 символов";
        } else {
            $error = [];
        }
        return $error;
    }

    public function translit(string $s): string
    {
        //$s = (string) $s; // преобразуем в строковое значение
        $s = trim($s); // убираем пробелы в начале и конце строки
        // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array(
            'а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e',
            'ё' => 'e','ж' => 'j','з' => 'z','и' => 'i','й' => 'y','к' => 'k',
            'л' => 'l','м' => 'm','н' => 'n','о' => 'o','п' => 'p','р' => 'r',
            'с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'h','ц' => 'c',
            'ч' => 'ch','ш' => 'sh','щ' => 'shch','ы' => 'y','э' => 'e','ю' => 'yu','я' => 'ya','ъ' => '','ь' => ''));
        $s = str_replace(' ', '-', $s);
        return $s; // возвращаем результат
    }

    public static function addArticle(array $data): void
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("INSERT INTO `articles` (`id`, `name`, `email`, `url`, `header`, `content`, `date`) 
        VALUES (NULL, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $sth->execute([$data[0], $data[1], $data[2], $data[3], $data[4]]);
    }
}
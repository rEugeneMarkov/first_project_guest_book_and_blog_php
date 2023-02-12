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
        $data['content'] = trim($post['add_article_content']);
        $data['url'] = self::translit($data['header']);
        return $data;
    }

    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    public static function validate(array $data): array
    {
        $error = [];
        if (strlen($data['header']) <= 10) {
            $error['header'] = "Введите корректный заголовок больше 10 символов";
        } elseif (self::isHeaderExists($data['header']) == true) {
            $error['header'] = "Такая статья уже существует";
        } elseif (strlen($data['content']) < 200) {
            $error['content'] = "Минимальная длинна статьи 200 символов";
        } else {
            $error = [];
        }
        return $error;
    }

    public static function translit(string $s): string
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

    /**
     * @param array <string, int|string> $data
     */
    public static function addArticle(array $data): void
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("INSERT INTO `articles` (`id`, `user_id`, `url`, `header`, `content`, `date`) 
        VALUES (NULL, :user_id, :url, :header, :content, CURRENT_TIMESTAMP)");
        $sth->execute($data);
    }

    public static function isHeaderExists(string $header): bool
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("SELECT `header` FROM `articles` WHERE header = ?");
        $sth->execute([$header]);
        $row = $sth->rowCount();
        return $row > 0;
    }
}

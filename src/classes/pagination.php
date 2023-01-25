<?php

namespace Classes;

class Pagination
{
    public int $kol; // количество записей для вывода
    public int $art; // с какой записи выводить
    public int $total; // всего записей
    public int $page; // текущая страница
    public int $strPag; // количество страниц пагинации


    /**
     * @param array<string, int> $get
     */
    public function __construct(string $table, int $kol, array $get)
    {
        $this->kol = $kol;
        $this->page = $this->getPageFromGet($get);
        $this->art = ($this->page * $this->kol) - $this->kol;
        $this->total = \models\Base::getTableCount($table);
        $str = ceil($this->total / $this->kol);
        $this->strPag = (int) $str;
    }

    /**
     * @param array<string, int> $get
     */

    private function getPageFromGet(array $get): int
    {
        if (isset($get['page'])) {
            $page = $get['page'];
        } else {
            $page = 1;
        }
        return $page;
    }
    /**
     * @return array<string, int>
     */
    public static function getDataPages(int $page, int $strPag): array
    {
        $pages = [];
        $pages['page'] = $page;
        $pages['str_pag'] = $strPag;
        if ($page > 1) {
            $pages['previus_page'] = $page - 1;
        } else {
            $pages['previus_page'] = $page;
        }
        if ($page < $strPag) {
            $pages['next_page'] = $page + 1;
        } else {
            $pages['next_page'] = $page;
        }
        return $pages;
    }
}

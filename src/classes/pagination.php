<?php

namespace Classes;

class Pagination
{
    public int $rowCount; // количество записей для вывода
    public int $firstRow; // с какой записи выводить
    public int $totalRows; // всего записей
    public int $currentPage; // текущая страница
    public int $pagesCount; // количество страниц пагинации


    /**
     * @param array<string, int|string> $get
     */
    public function __construct(string $table, int $rowCount, array $get)
    {
        $this->rowCount = $rowCount;
        $this->currentPage = $this->getPageFromGet($get);
        $this->firstRow = ($this->currentPage * $this->rowCount) - $this->rowCount;
        $this->totalRows = \models\Base::getTableCount($table);
        $str = ceil($this->totalRows / $this->rowCount);
        $this->pagesCount = (int) $str;
    }

    /**
     * @param array<string, int|string> $get
     */

    private function getPageFromGet(array $get): int
    {
        if (isset($get['page'])) {
            $page = $get['page'];
        } else {
            $page = 1;
        }
        $page = (int) $page;
        return $page;
    }
    /**
     * @return array<string, int>
     */
    public function getPagesInfo(): array
    {
        $pages = [];
        $currentPage = $this->currentPage;
        $pages['currentPage'] = $currentPage;
        $pages['pagesCount'] = $this->pagesCount;
        if ($currentPage > 1) {
            $pages['previous_page'] = $currentPage - 1;
        } else {
            $pages['previous_page'] = $currentPage;
        }
        if ($currentPage < $this->pagesCount) {
            $pages['next_page'] = $currentPage + 1;
        } else {
            $pages['next_page'] = $currentPage;
        }
        return $pages;
    }
}

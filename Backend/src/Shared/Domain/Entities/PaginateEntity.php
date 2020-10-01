<?php


namespace App\Shared\Domain\Entities;


class PaginateEntity
{
    public array $rows = [];
    public int $totalRows = 0;
    public int $totalPages = 0;

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return int
     */
    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    /**
     * @param int $totalRows
     */
    public function setTotalRows(int $totalRows): void
    {
        $this->totalRows = $totalRows;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     */
    public function setTotalPages(int $totalPages): void
    {
        $this->totalPages = $totalPages;
    }




}
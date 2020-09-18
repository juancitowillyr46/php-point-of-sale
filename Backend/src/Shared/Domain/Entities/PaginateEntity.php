<?php


namespace App\Shared\Domain\Entities;


class PaginateEntity
{
    public array $registers = [];
    public int $totalRegisters = 0;
    public int $totalPages = 0;

    /**
     * @return array
     */
    public function getRegisters(): array
    {
        return $this->registers;
    }

    /**
     * @param array $registers
     */
    public function setRegisters(array $registers): void
    {
        $this->registers = $registers;
    }

    /**
     * @return int
     */
    public function getTotalRegisters(): int
    {
        return $this->totalRegisters;
    }

    /**
     * @param int $totalRegisters
     */
    public function setTotalRegisters(int $totalRegisters): void
    {
        $this->totalRegisters = $totalRegisters;
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
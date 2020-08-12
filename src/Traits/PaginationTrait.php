<?php

namespace App\Traits;

trait PaginationTrait
{
    public function getFirstResult(int $page, int $perpage)
    {
        return $page >= 1 ? ($page - 1) * $this->getMaxResults($perpage) : 1;
    }

    public function getMaxResults(int $perpage)
    {
        return $perpage > 1 ? $perpage : 10;
    }
}
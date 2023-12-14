<?php

namespace App\Services\Webs;

use App\Objects\SelectItem;
use App\Repositorys\LineRepositoryInterface;

/**
 * LineService
 * 
 */
class LineService implements LineServiceInterface
{
    /**
     * LineRepositoryInterface
     * 
     */
    private $lineRepository;

    /**
     * __construct
     * 
     * @param LineRepositoryInterface lineRepository
     */
    public function __construct(LineRepositoryInterface $lineRepository)
    {
        $this->lineRepository = $lineRepository;
    }

    /**
     * LINE情報を取得
     * 
     * @param int id ID
     * @return Line LINE情報
     */
    public function getLine($id)
    {
        return $this->lineRepository->findById($id);
    }
}
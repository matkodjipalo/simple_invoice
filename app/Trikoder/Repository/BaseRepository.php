<?php

namespace Trikoder\Repository;

use PDO;

/**
 * Bazni repozitorij
 *
 * Brine se za postavljanje veze s bazom
 */
class BaseRepository
{
    /** @var PDO */
    protected $pdo;

    /**
     *
     * @param PDO $pdo [description]
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientRepository extends EntityRepository
{
    public function findOneByUuid(string $id): ?Client
    {
        try {
            $uuid = Uuid::fromString($id);
        } catch (InvalidUuidStringException $exception) {
            throw new NotFoundHttpException(sprintf('Invalid Client ID: %s', $id));
        }
        return $this->findOneBy(['uuid' => $uuid]);
    }
}
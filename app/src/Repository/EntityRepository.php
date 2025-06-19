<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class EntityRepository
{
    /**
     * @var string
     */
    protected static string $className;

    /**
     * @var ObjectRepository
     */
    protected ObjectRepository $repository;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(
        EntityManagerInterface $em,
    )
    {
        $this->em = $em;
        $this->repository = $em->getRepository(static::$className);
    }

    /**
     * @param $id
     *
     * @return object|null
     * @see ObjectRepository
     */
    public function find($id): ?object
    {
        return $this->repository->find($id);
    }

    /**
     * @return string
     * @see ObjectRepository
     */
    public function getClassName(): string
    {
        return $this->repository->getClassName();
    }

    /**
     * @param object $object
     */
    public function persistAndFlush(object $object): void
    {
        $this->persist($object);
        $this->flush();
    }


    /**
     * @param object $entity
     */
    public function persist(object $entity): void
    {
        $this->em->persist($entity);
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->em->flush();
    }


    /**
     * @param string $className
     *
     * @return ObjectRepository
     */
    public function getRepository(string $className): ObjectRepository
    {
        return $this->em->getRepository($className);
    }
}

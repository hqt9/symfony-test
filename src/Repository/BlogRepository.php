<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blog>
 *
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function add(array $param, bool $flush = true): void
    {
        $text = mt_rand(100, 999);
        $date = date('Y-m-d H:i:s');

        $blog = new Blog();
        $blog->setAuthor($param['author'] ?? $text);
        $blog->setSummary($param['summary'] ?? $text);
        $blog->setContent($param['content'] ?? $text);
        $blog->setImage('1_16848988913098.png');
        $blog->setStatus(1);
        $blog->setCreatedAt($date);
        $blog->setUpdatedAt($date);

        $this->getEntityManager()->persist($blog);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Blog[] Returns an array of Blog objects
     */
    public function list($param): array
    {
        $query = $this->createQueryBuilder('b')
            ->orderBy('b.updated_at', 'DESC')
            ->setMaxResults(null);

        if (!empty($param['author']))
            $query->andWhere('b.author like :author')->setParameter('author', '%' . $param['author'] . '%');

        if (!empty($param['summary']))
            $query->andWhere('b.summary like :summary')->setParameter('summary', '%' . $param['summary'] . '%');

        return $query->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?Blog
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function update($param)
    {
        $blog = $this->find($param['id']);

        if (empty($blog))
            throw new \Exception('Blog is not exist.');

        if (!empty($param['author']))
            $blog->setAuthor($param['author']);

        if (!empty($param['summary']))
            $blog->setAuthor($param['summary']);

        if (!empty($param['content']))
            $blog->setAuthor($param['content']);

        $blog->setUpdatedAt(date('Y-m-d H:i:s'));

        $this->getEntityManager()->flush();
    }

    public function remove(int $id, bool $flush = true): void
    {
        $this->createQueryBuilder('b')
            ->update()
            ->set('b.status', 2)
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();

        // $blog = $this->find($id);
        // $this->getEntityManager()->remove($blog);
        // if ($flush) {
        //     $this->getEntityManager()->flush();
        // }
    }
}

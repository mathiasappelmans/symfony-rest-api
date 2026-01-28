<?php

namespace App\Repository;

use App\Dto\ListCocktailsQuery;
use App\Entity\Cocktail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cocktail>
 */
class CocktailRepository extends ServiceEntityRepository
{
	
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cocktail::class);
    }


		public function findAllWithQuery(ListCocktailsQuery $query)
		{
			$qb = $this->createQueryBuilder('c');

			if ($query->name) {
				$qb->andWhere('c.name LIKE :name')
					->setParameter('name', "%$query->name%");
			}
			if (null !== $query->isAlcoholic) {
				$qb
					->andWhere('c.isAlcoholic = :isAlcoholic')
					->setParameter('isAlcoholic', $query->isAlcoholic);
			}
			if ($query->difficulty) {
				$qb->andWhere('c.difficulty = :difficulty')
					->setParameter('difficulty',$query->difficulty);
			}

			$offset = ($query->page -1 ) * $query->itemsPerPage;

			$qb->setFirstResult($offset)
				->setMaxResults($query->itemsPerPage);

			return $this->createQueryBuilder('c')
				->setMaxResults()

			return $qb->getQuery()->getResult();
		}
}

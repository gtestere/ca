<?php

namespace App\Repository;

use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

		public function findByBetweenDate($from, $to, Hotel $hotel)
		{
			$interval = $this->getDateGroup($from, $to);
			$qb = $this->createQueryBuilder('r');
			$qb->select("count(r.score) as review_count, avg(r.score) as score, $interval(r.create_date) as date_group");
			$qb->andWhere('r.hotel = :hotel')
			   ->setParameter('hotel', $hotel);

			$qb->andWhere('r.create_date BETWEEN :from AND :to')
			   ->setParameter('from', $from)
			   ->setParameter('to', $to);
			$qb->orderBy('date_group');
			$qb->groupBy("date_group");
			return [
				'data' => $qb->getQuery()->getResult(),
				'interval' => $interval
			];
		}

		private function getDateGroup($from, $to) {
			$diff = date_diff(date_create_from_format('yy-m-d',$to), date_create_from_format('yy-m-d',$from));
			switch (true) {
				case ($diff->days >= 89):
					$interval = 'month';
					break;
				case ($diff->days >= 30):
					$interval = 'week';
					break;
				default:
					$interval = '';
					break;
			}
			return $interval;
		}
}

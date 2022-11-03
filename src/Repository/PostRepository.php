<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\Post;
use App\Entity\Tag;
use App\Pagination\Paginator;
use Cycle\SymfonyBundle\Repository\CycleServiceRepository;
use function Symfony\Component\String\u;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 *
 * See https://symfony.com/doc/current/doctrine.html#querying-for-objects-the-repository
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class PostRepository extends CycleServiceRepository
{
    public static function getEntityClass(): string
    {
        return Post::class;
    }

    public function findLatest(int $page = 1, Tag $tag = null): Paginator
    {
        $select = $this->select()
            ->where('publishedAt', '<=', new \DateTime())
            ->orderBy('publishedAt', 'DESC');

        if (null !== $tag) {
            $select->andWhere('tags.id', '=', $tag->getId());
        }

        return (new Paginator($select))->paginate($page);
    }

    /**
     * @return Post[]
     */
    public function findBySearchQuery(string $query, int $limit = Paginator::PAGE_SIZE): array
    {
        $searchTerms = $this->extractSearchTerms($query);

        if (0 === \count($searchTerms)) {
            return [];
        }

        $select = $this->select();

        foreach ($searchTerms as $key => $term) {
            $select->orWhere('title', 'like', '%'.$term.'%');
        }

        return $select
            ->limit($limit)
            ->orderBy('publishedAt', 'DESC')
            ->fetchAll();
    }

    /**
     * Transforms the search string into an array of search terms.
     */
    private function extractSearchTerms(string $searchQuery): array
    {
        $searchQuery = u($searchQuery)->replaceMatches('/[[:space:]]+/', ' ')->trim();
        $terms = array_unique($searchQuery->split(' '));

        // ignore the search terms that are too short
        return array_filter($terms, static function ($term) {
            return 2 <= $term->length();
        });
    }
}

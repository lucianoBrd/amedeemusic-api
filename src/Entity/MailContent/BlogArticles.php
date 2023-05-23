<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\BlogArticles\Article;
use App\Entity\MailContent\MailContentInterface;

class BlogArticles extends MailContent implements MailContentInterface
{
    private array $articles;

    public function __construct()
    {
        $this->articles = [];
    }

    /**
     * @return array<Article>
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!array_key_exists($article->getId(), $this->articles)) {
            $this->articles[$article->getId()] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if (array_key_exists($article->getId(), $this->articles)) {
            unset($this->articles[$article->getId()]);
        }

        return $this;
    }
}

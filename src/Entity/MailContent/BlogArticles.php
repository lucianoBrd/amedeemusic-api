<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\BlogArticles\Article;

class BlogArticles implements MailContent
{
    private ?string $id = null;
    private ?string $title = null;
    private ?string $titleBold = null;
    private ?string $paragraph = null;
    private array $articles;

    public function __construct()
    {
        $this->id = uniqid();
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
            $article->setBlogArticles($this);
        }

        return $this;
    }

    public function removeBlog(Article $article): self
    {
        if (array_key_exists($article->getId(), $this->articles)) {
            unset($this->articles[$article->getId()]);

            // set the owning side to null (unless already changed)
            if ($article->getBlogArticles() === $this) {
                $article->setBlogArticles(null);
            }
        }

        return $this;
    }

	/**
	 * @return 
	 */
	public function getId(): ?string {
		return $this->id;
	}

	/**
	 * @return 
	 */
	public function getTitle(): ?string {
		return $this->title;
	}
	
	/**
	 * @param  $title 
	 * @return self
	 */
	public function setTitle(?string $title): self {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getTitleBold(): ?string {
		return $this->titleBold;
	}
	
	/**
	 * @param  $titleBold 
	 * @return self
	 */
	public function setTitleBold(?string $titleBold): self {
		$this->titleBold = $titleBold;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getParagraph(): ?string {
		return $this->paragraph;
	}
	
	/**
	 * @param  $paragraph 
	 * @return self
	 */
	public function setParagraph(?string $paragraph): self {
		$this->paragraph = $paragraph;
		return $this;
	}
}

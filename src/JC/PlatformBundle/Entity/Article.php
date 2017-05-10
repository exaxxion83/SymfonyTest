
<?php

namespace JC\PlatformBundle\Entity;


class Article
{

	public $article;
	

	public function getArticle()
	{
		return $this->article;
	}

	public function setArticle($article)
	{
		$this->article = $article;
	}

}

?>
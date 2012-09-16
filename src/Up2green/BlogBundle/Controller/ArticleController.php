<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\BlogBundle\Model\Article;

use Up2green\BlogBundle\Model\ArticleQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Article controller
 */
class ArticleController extends Controller
{
    /**
     * Searches for the article with {id}
     *
     * @param Article $article
     *
     * @Route("/article/{id}", name="blog_article_show")
     * @Template()
     * @return array
     */
    public function showAction(Article $article)
    {
        $article->setLocale($this->getRequest()->getLocale());

        return array('article' => $article);
    }
}

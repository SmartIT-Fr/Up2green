<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\BlogBundle\Model\Article;

use Up2green\BlogBundle\Model\ArticleQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter;

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

    /**
	 * Displays list of all articles
	 *
     * @Route("/article/", name="blog_article_list")
     * @Template()
     * @return array
     */
    public function listAction()
    {
        $adapter = new PropelAdapter(ArticleQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale()));

        $pager = new Pagerfanta($adapter);
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array('pager' => $pager);
    }
}

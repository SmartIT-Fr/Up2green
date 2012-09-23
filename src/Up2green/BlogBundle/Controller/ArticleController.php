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
     * @Route("/article/{id}", name="blog_article_show", requirements={"id"= "\d+"})
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
        $pager = $this->getPager($this->getRequest()->get('page', 1), 10);

        return $pager;
    }

    /**
	 * Displays list of articles in ajax
	 *
	 * @param integer $page
     *
     * @Route("/article/listAjax/{page}", name="blog_article_list_ajax", defaults={"page"= 1}, options={"expose"=true})
     * @Template()
     * @return array
	 */
    public function listAjaxAction($page = 1)
    {
        $return = $this->getPager($page, $this->getRequest()->get('limit', 1));
        $return['options']['routeName'] = $this->getRequest()->get('routeName', '');
        $return['options']['routeParams'] = $this->getRequest()->get('routeParams', '');

        return $return;
    }

    /**
	 * Gets list of all articles
	 *
	 * @param integer $page  The page
	 * @param integer $limit The limit
     *
     * @return array
     */
    private function getPager($page, $limit)
    {
        $adapter = new PropelAdapter(ArticleQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale()));

        $pager = new Pagerfanta($adapter);
        $pager
            ->setMaxPerPage($limit)
            ->setCurrentPage($page);

        return array('pager' => $pager);
    }
}

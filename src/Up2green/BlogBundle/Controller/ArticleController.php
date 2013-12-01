<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\BlogBundle\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

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
     * @Template(vars={"article"})
     * @return array
     */
    public function showAction(Article $article)
    {
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
        $query = $this->getDoctrine()->getRepository('Up2greenBlogBundle:Article')->createQueryBuilder('a');

        $adapter = new DoctrineORMAdapter($query);
        $pager = new Pagerfanta($adapter);
        $pager
            ->setMaxPerPage($limit)
            ->setCurrentPage($page);

        return array('pager' => $pager);
    }
}

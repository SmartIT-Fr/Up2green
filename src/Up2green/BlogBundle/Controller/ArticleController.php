<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\BlogBundle\Model\Article;

use Up2green\BlogBundle\Model\ArticleQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller
 */
class ArticleController extends Controller
{
    /**
     * @Route("/article/{id}", name="blog_article_show")
     *
     * @Template(vars={"article"})
     */
    public function showAction(Article $article)
    {
    }
}

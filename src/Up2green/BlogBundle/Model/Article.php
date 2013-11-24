<?php

namespace Up2green\BlogBundle\Model;

use Up2green\BlogBundle\Model\om\BaseArticle;

/**
 * Article entity
 */
class Article extends BaseArticle
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->isNew() ? "New article" : (string) $this->getTitle();
    }

    public function addArticleI18n()
    {
        // FIXME
    }
}

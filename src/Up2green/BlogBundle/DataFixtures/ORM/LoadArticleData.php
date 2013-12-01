<?php

namespace Up2green\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\BlogBundle\Entity\Article;

/**
 * Class LoadArticleData
 */
class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\Translatable\Entity\Translation');

        $articlePrivacy = new Article();
        $articlePrivacy->setIsActive(true);
        $articlePrivacy->setTitle('Privacy');

        $repository->translate($articlePrivacy, 'title', 'fr', 'Clause de confidentialité')
            ->translate($articlePrivacy, 'summary', 'fr', "<p>\r\n\tCe site web <span>est</span> <span>géré</span> par <span>l'Association</span> <span>UP2GREEN</span> REFORESTATION (Association <span>française</span> de <span>loi</span><br />\r\n\t1901). <span>Lors</span> de <span>votre</span> <span>visite</span> de <span>ce</span> site, <span>l'Association</span> <span>Up2green</span> Reforestation <span>peut</span> <span>recueillir</span> <span>des</span> <span>données</span><br />\r\n\t<span>personnelles</span> <span>vous</span> <span>concernant</span> : un e-mail et de <span>façon</span> <span>optionnelle</span> un nom et un <span>prénom</span> <span>sur</span> la base de<br />\r\n\t<span>votre</span> <span>choix</span> de <span>renseignement</span>.</p>\r\n")
            ->translate($articlePrivacy, 'description', 'fr', "<p>\r\n\tL'Association UP2GREEN REFORESTATION pourra utiliser ces données exclusivement dans le<br />\r\n\tcadre des objectifs fixés par la présente clause de confidentialité, et prendra les mesures nécessaires<br />\r\n\tà la protection des données personnelles.<br />\r\n\t<br />\r\n\t<u><strong>Objectifs de la collecte des données</strong></u><br />\r\n\t<br />\r\n\tL'Association UP2GREEN REFORESTATION recueille et gère les données des clients et des<br />\r\n\tvisiteurs de ce site internet dans le cadre de sa gestion associative, pour nous permettre d'améliorer<br />\r\n\tle service rendu par les sites (moteur de recherche, plate-forme de plantation), et pour établir des<br />\r\n\tstatistiques internet. Les informations que vous nous transmettez (e-mail) peuvent être utilisées<br />\r\n\tpour nous permettre de vous contacter en cas de besoin, par exemple pour vous tenir informé<br />\r\n\tde modifications des fonctionnalités internet ou pour vous proposer de nouveaux services que<br />\r\n\tvous seriez susceptible d'apprécier (sauf si vous avez précisé que vous ne désiriez pas recevoir<br />\r\n\td'information sur les évolutions de l'Association UP2GREEN REFORESTATION).<br />\r\n\t<br />\r\n\t<u><strong>Cookies</strong></u><br />\r\n\t<br />\r\n\tLes sites de l'Association UP2GREEN REFORESTATION n'installe aucun cookie sur votre ordinateur.<br />\r\n\t<br />\r\n\t<u><strong>Sites tiers</strong></u><br />\r\n\t<br />\r\n\tCette clause de confidentialité ne s'applique pas aux site tiers reliés à ce site au moyen de liens.<br />\r\n\t<br />\r\n\t<u><strong>Droits d'auteur, marques de fabrique et autres droits de propriété intellectuelle</strong></u><br />\r\n\t<br />\r\n\tLe contenu de ce site Internet, y compris sans toutefois s'y limiter les logos, les marques de fabrique,<br />\r\n\tles appellations commerciales, le texte, les images, les graphiques, le son, l'animation et les<br />\r\n\tfichiers vidéo ainsi que leur disposition sur le site Internet appartiennent à l'Association UP2GREEN<br />\r\n\tREFORESTATION et ledit contenu est soumis à la protection de la propriété intellectuelle. Aucun<br />\r\n\tcontenu du site Internet ne peut être reproduit, copié, transféré, publié, distribué, modifié, déplacé, ou<br />\r\n\ttransféré sur d'autres sites Internet ou documents sans autorisation écrite préalable. Tous les droits<br />\r\n\tde propriété intellectuelle contenus dans le site Internet, y compris les droits d'auteur sont réservés et<br />\r\n\ttoute utilisation sans autorisation écrite préalable par l'utilisateur respectif est formellement interdite.<br />\r\n\tRien de ce qui est contenu sur ce site Internet ne sera interprété comme accordant la moindre<br />\r\n\tlicence expresse ou implicite ou le moindre droit d'utiliser la propriété intellectuelle de l'Association<br />\r\n\tUP2GREEN REFORESTATION ou de toute tierce partie.<br />\r\n\t<br />\r\n\t<u><strong>Questions</strong></u><br />\r\n\t<br />\r\n\tEn cas de questions concernant cette clause de confidentialité, nos activités dans le domaine de<br />\r\n\tla gestion des données ou votre utilisation de ce site, vous pouvez vous contacter à l'aide de notre<br />\r\n\tadresse email webmaster@up2green.com<br />\r\n\t<br />\r\n\t<u><strong>Modifications de cette Clause de confidentialité</strong></u><br />\r\n\t<br />\r\n\tL'Association Up2green Reforestation se réserve le droit d'apporter des modifications à cette clause<br />\r\n\tde confidentialité. Nous vous conseillons de consulter régulièrement cette clause de confidentialité<br />\r\n\tpour vous tenir informé des éventuelles modifications.<br />\r\n\t<br />\r\n\tL'Association Up2green Reforestation</p>\r\n<br />\r\n")
        ;

        $articleLegal = new Article();
        $articleLegal->setIsActive(true);
        $articleLegal->setTitle('Legal');

        $repository->translate($articleLegal, 'title', 'fr', 'Mentions légales')
            ->translate($articleLegal, 'description', 'fr', "<p>\r\n\tLe <span>présent</span> site web <span>est</span> accessible via <span>l'adresse</span> URL : <a href=\"http://www.up2green.com/\">http://<span>association.up2green.com</span>/</a></p>\r\n<p>\r\n\tUP2GREEN REFORESTATION est une Association Loi 1901 a but non lucratif.</p>\r\n<p>\r\n\tDate de parution au Journal Officiel : 28/11/2009</p>\r\n<p>\r\n\tN° d'identification R.N.A. : <b><span>W751202385</span></b></p>\r\n<p>\r\n\t<br />\r\n\tNo de <span>parution</span> : <b>20090048</b></p>\r\n<p>\r\n\t<span>Département</span> (<span>Région</span>)<b><span> : </span></b><b>Paris (<span>Île-de-France</span>)</b></p>\r\n")
        ;

        $manager->persist($articlePrivacy);
        $manager->persist($articleLegal);
        $manager->flush();

        $this->addReference('article-privacy', $articlePrivacy);
        $this->addReference('article-legal', $articleLegal);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
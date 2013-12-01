<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\ReforestationBundle\Entity\Program;

/**
 * Class LoadProgramData
 */
class LoadProgramData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $program1 = new Program();
        $program1->setTitle('Burkina Faso');
        $program1->setAddedTrees(5000);
        $program1->setSummary('<p>Sahel, Nord du Burkina Faso. Lutte contre la désertification et reboisements des parcelles touaregs et peules.</p>');
        $program1->setDescription('<p>\r\n\t<img alt="" src="/uploads/ck/images/Plants-2.jpg" style="width: 230px; height: 173px;" /><img alt="" src="/uploads/ck/images/IMG_0191.jpg" style="width: 230px; height: 173px;" /><img alt="" src="/uploads/ck/images/IMG_0496.jpg" style="width: 230px; height: 153px;" /><img alt="" src="/uploads/ck/images/IMG_0255.jpg" style="width: 230px; height: 153px;" /></p>\r\n<p>\r\n\t<strong>Enjeux</strong> : lutter contre l&#39;avanc&eacute;e du d&eacute;sert, lutter contre la pauvret&eacute;</p>\r\n<p>\r\n\t<strong>Partenaire</strong> : Projets plus actions</p>\r\n<p>\r\n\t<strong>Programme</strong> : Developpement du sahel burkinabais</p>\r\n<p>\r\n\t<strong>Localisation </strong>: Gandefabou, province de l&#39;Oudalan, sahel du Burkina Faso</p>\r\n<p>\r\n\t<strong>B&eacute;n&eacute;ficiaires</strong> : Les villageois du campement touareg de Gandefabou</p>\r\n<p>\r\n\t<strong>Implication Up2Green </strong>: contribuer aux activit&eacute;s de reboisement. Former les villageois pour le d&eacute;veloppement de leurs propres p&eacute;pini&egrave;res.</p>\r\n<p>\r\n\t&nbsp;</p>\r\n<p>\r\n\t<strong>Description plus d&eacute;taill&eacute;e :</strong></p>\r\n<p>\r\n\t&nbsp;</p>\r\n<p>\r\n\t<u><em>Contexte</em></u>:</p>\r\n<p style="text-align: justify;">\r\n\tL&#39;association Projets plus Action poursuit, g&egrave;re et coordonne un programme de d&eacute;veloppement &eacute;conomique dans le Sahel Burkinabais et plus particuli&egrave;rement du campement de Gand&eacute;fabou Ce campement d&rsquo;accueil est de type solidaire, car en effet, son but est de permettre le d&eacute;veloppement local, d&rsquo;am&eacute;liorer les conditions de vie des villageois, de limiter l&rsquo;exode vers la C&ocirc;te d&rsquo;Ivoire pour travailler dans les champs de coton et les exploitations banani&egrave;res, de cr&eacute;er des emplois et donc de la richesse, de prot&eacute;ger la faune et la flore. Pour se faire, l&rsquo;association m&egrave;ne dif&eacute;rentes actions aupr&egrave;s de la population du village de Gandefabou et reverse une partie des b&eacute;n&eacute;fices g&eacute;n&eacute;r&eacute;s par l&rsquo;activit&eacute; touristique pour le d&eacute;veloppement local. Cette r&eacute;gion du Burkina Faso est en effet particuli&egrave;rement aride, difficile et soumise aux variations climatiques d&#39;o&ugrave; l&#39;importance de reverdir la zone.</p>\r\n<p style="text-align: justify;">\r\n\t&nbsp;</p>\r\n<p style="text-align: justify;">\r\n\t<u><em>Objectifs:</em></u></p>\r\n<p style="text-align: justify;">\r\n\t- appuyer financi&egrave;rement les populations nomades</p>\r\n<p style="text-align: justify;">\r\n\t- limiter l&#39;&eacute;rosion des sols par la plantations d&#39;arbres</p>\r\n<p style="text-align: justify;">\r\n\t- fournir du fourrage par la plantaion de l&eacute;gumineuses</p>\r\n<p style="text-align: justify;">\r\n\t- cr&eacute;er une activit&eacute; &eacute;conomique durable par la plantation d&#39;esp&egrave;ces valorisables</p>\r\n<p style="text-align: justify;">\r\n\t- am&eacute;ilorer la qualit&eacute; du site &eacute;cotouristique</p>');
        $program1->setMaxTree(15000);
        $program1->setLogo('/uploads/programs/1/logo.jpg');
        $program1->setOrganization($this->getReference('organization-trees-for-the-future'));

        $program2 = new Program();
        $program2->setTitle('Madagascar');
        $program2->setAddedTrees(8000);
        $program2->setMaxTree(15000);
        $program2->setLogo('/uploads/programs/2/logo.jpg');

        $program3 = new Program();
        $program3->setTitle('Sénégal');
        $program3->setMaxTree(15000);
        $program3->setLogo('/uploads/programs/3/logo.jpg');

        $program4 = new Program();
        $program4->setTitle('Bénin');
        $program4->setAddedTrees(3102);
        $program4->setMaxTree(15000);
        $program4->setLogo('/uploads/programs/4/logo.jpg');

        $program5 = new Program();
        $program5->setTitle('Equateur');
        $program5->setAddedTrees(9112);
        $program5->setMaxTree(15000);
        $program5->setLogo('/uploads/programs/5/logo.jpg');

        $program6 = new Program();
        $program6->setTitle('Pérou');
        $program6->setAddedTrees(5627);
        $program6->setMaxTree(15000);
        $program6->setLogo('/uploads/programs/6/logo.jpg');

        $program7 = new Program();
        $program7->setTitle('Colombie');
        $program7->setAddedTrees(6582);
        $program7->setMaxTree(15000);
        $program7->setLogo('/uploads/programs/7/logo.jpg');

        $program8 = new Program();
        $program8->setTitle('Costa Rica');
        $program8->setAddedTrees(4512);
        $program8->setMaxTree(15000);
        $program8->setLogo('/uploads/programs/8/logo.jpg');

        $program9 = new Program();
        $program9->setTitle('Thailande');
        $program9->setAddedTrees(18000);
        $program9->setMaxTree(15000);
        $program9->setLogo('/uploads/programs/9/logo.jpg');

        $manager->persist($program1);
        $manager->persist($program2);
        $manager->persist($program3);
        $manager->persist($program4);
        $manager->persist($program5);
        $manager->persist($program6);
        $manager->persist($program7);
        $manager->persist($program8);
        $manager->persist($program9);
        $manager->flush();

        $this->addReference('program-burkina-faso', $program1);
        $this->addReference('program-madagascar', $program2);
        $this->addReference('program-senegal', $program3);
        $this->addReference('program-benin', $program4);
        $this->addReference('program-equateur', $program5);
        $this->addReference('program-perou', $program6);
        $this->addReference('program-colombie', $program7);
        $this->addReference('program-costa-rica', $program8);
        $this->addReference('program-thailande', $program9);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
<?php

namespace Up2green\CommonBundle\Repository;

use Doctrine\ORM\EntityRepository;

class VoucherRepository extends EntityRepository
{
    public static $length = 9;
    public static $acceptedChars = 'ABCDEFGHKLMNOPQRSTWXYZ123456789';

    /**
     * Retourne un code coupon non utilisé
     *
     * @param String $prefix
     * @param Array $exclude liste de code a exclure lors de l'exécution récursive
     *
     * @return String numéro de coupon libre
     */
    public function getCodeUnused($prefix = '', $exclude = array())
    {
        if(strlen($prefix) > self::$length) {
            throw new Exception(sprintf("Prefix size is > to the max (%s)", self::$length));
        }

        $prefix = self::cleanCode($prefix);

        do {
            $code = $prefix . self::cleanCode(self::getRandCode(self::$length - strlen($prefix)));
        } while (in_array($code, $exclude));

        if (! $this->findOneByCode($code)) {
            // code ok, not found in database
            return $code;
        }

        if(strlen($prefix) >= self::$length) {
            // cant generate a valide code
            throw new Exception(sprintf("Coupon already exist with code %s", $code));
        }

        $codes = $this->createQueryBuilder('v')
            ->select('v.code')
            ->where('v.code LIKE :prefix')
            ->setParameter('prefix', $prefix.'%')
            ->getQuery()
            ->getArrayResult();

        die(var_dump($codes));

        $possibilities = pow(strlen(self::$acceptedChars), self::$length - strlen($prefix));

        if($possibilities === sizeof($codes) ) {
            // cant generate a valide code
            throw new Exception(sprintf("All possibilities with prefix %s are already used", $prefix));
        }

        return self::getCodeUnused($prefix, $codes);
    }

    /**
     * @param integer $length
     *
     * @return string
     */
    public static function getRandCode($length) {
        $max = strlen(self::$acceptedChars) - 1;
        $code = '';
        mt_srand((double)microtime()*1000000);
        while (strlen($code) < $length)
            $code .= self::$acceptedChars{mt_rand(0, $max)};

        return $code;
    }

    /**
     * @param string $code
     *
     * @return string
     */
    public static function cleanCode($code) {
        // replace non letter or digits
        $code = preg_replace('#[^\\pL\d]+#u', '', $code);

        return strtoupper(trim($code));
    }
}
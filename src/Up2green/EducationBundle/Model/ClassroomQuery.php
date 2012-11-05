<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseClassroomQuery;

/**
 * ClassroomPeer class
 *
 * @deprecated Peer classes should not be used
 */
class ClassroomQuery extends BaseClassroomQuery
{
    /**
     * @param array $datas
     *
     * @return \Up2green\EducationBundle\Model\ClassroomQuery
     */
    public function filterSearch(array $datas)
    {
        $datas = array_filter($datas);

        foreach($datas as $key => $value) {
            if (is_array($value) && $key === 'school') {
                $this->useSchoolQuery()->filterSearch($value)->endUse();
            } else {
                $columnKey = ucwords($key);
                $this->filterBy($columnKey, $value);
            }
        }

        return $this;
    }
}

<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseSchoolQuery;

/**
 * SchoolQuery class
 */
class SchoolQuery extends BaseSchoolQuery
{
    /**
     * @param array $datas
     *
     * @return \Up2green\EducationBundle\Model\SchoolQuery
     */
    public function filterSearch(array $datas)
    {
        $datas = array_filter($datas);

        foreach($datas as $key => $value) {
            $columnKey = ucwords($key);
            $this->filterBy($columnKey, "%".$value."%", \Criteria::LIKE);
        }

        return $this;
    }
}

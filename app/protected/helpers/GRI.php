<?php
class GRI
{
    public function getIndex($data, $row, $column)
    {
        $grid  = $column->grid;
        $pages = $grid->dataProvider->getPagination();
        $start = ($grid->enablePagination === false) ? 0 : $pages->getCurrentPage(false) * $pages->getPageSize();
        return $start + $row + 1;
    }
    
    /**
     * Returns row index for manual pagination pages
     * @param  integer $row
     * @param  integer $currentPage
     * @param  integer $pageSize
     * @return integer
     */
    public function getIndexManual($row, $currentPage, $pageSize = 10) {
        if (!empty($currentPage)) {
            $currentPage -= 1;
        }
        $res =  ($row + 1) + ($currentPage * $pageSize);
        return (string)$res;
    }

    /**
     * Show / hide button by username
     * @param  string $username
     * @return boolean
     */
    public function buttonByUsername($username) {
        $usernames = array(
            'admin' => true,
            'default' => true,
            'default_temp' => true
        );
        return !isset($usernames[$username]);
    }

    /**
     * Show / hide button by type
     * @param  string $type
     * @return boolean
     */
    public function buttonByType($type) {
        $types = array(
            'default' => true,
            'default_temp' => true
        );
        return !isset($types[$type]);
    }
}
<?php
class Cronphp_Model_Cronjob extends Zend_Db_Table_Abstract {
    protected $_name = 'cronjobs';
    protected $_rowClass = 'Cronphp_Model_Cronjob_Row';

    public function findByPath($id, $path, $server) {
        return $this->fetchRow($this->select()
            ->where('id = ?', $id)
            ->where('path = ?', $path)
            ->where('server = ?', $server)
        );
    }

    public function getActiveJobsByServer($server) {
        return $this->fetchAll($this->select()
            ->where('server = ?', $server)
            ->where('active = 1')
        );
    }
}

class Cronphp_Model_Cronjob_Row extends Zend_Db_Table_Row_Abstract {

    public function isActive() {
        return (bool) $this->active;
    }

    public function enable() {
        $this->active = 1;
        return $this;
    }

    public function disable() {
        $this->active = 0;
        return $this;
    }

    public function __toString() {
        return $this->path;
    }
}

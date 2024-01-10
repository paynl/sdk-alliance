<?php

namespace Paynl\Alliance\Result\Merchant;

class Get extends Merchant
{
    public function getBalance()
    {
        return $this->data['balance'] / 100;
    }

    public function getDocuments()
    {
        return $this->data['documents'];
    }

    public function getMissingDocuments()
    {
        $result = array();

        foreach ($this->data['documents'] as $document) {
            // status 2 = wordt gecontroleerd, 3 = goed
            if (!in_array($document['status_id'], array(2, 3))) {
                array_push($result, $document);
            }
        }
        foreach ($this->data['accounts'] as $account) {
            if (!empty($account['documents'])) {
                foreach ($account['documents'] as $document) {
                    if (!in_array($document['status_id'], array(2, 3))) {
                        $document['type_name'] .= ' - ' . $account['name'];
                        array_push($result, $document);
                    }
                }
            }
        }

        return $result;
    }

    public function getAccounts()
    {
        return $this->data['accounts'];
    }

}
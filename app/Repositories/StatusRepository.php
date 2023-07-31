<?php

namespace App\Repositories;


class StatusRepository
{
    /**
     * @param $state
     * @return array|int|mixed|string
     * @link use-enum https://www.php.net/manual/en/language.types.enumerations.php
     */


    public static function getReceiveStatus($state)
    {
        $statuses = [
            'draft' => 0, // created by technician if requisition is by technician
            'processing' => 1, // Has been created by store QM or approved by MO
            'processed' => 2, // Processed by OC awaiting QM approval
            'approved' => 3, // OC has approved the items
            'received' => 4, // QM has received the item to stock
            'mo-declined' => 5, // MO has declined the items
            'qm-declined' => 6, // QM has declined the items
            'declined' => 7, // OC has declined the items
        ];
        return self::checkState($state,$statuses);
    }

    public static function getIssueStatus($state)
    {
        $statuses = [
            'draft' => 0,
            'processing' => 1, // Has  been processed for MO approval
            'mo-approved' => 2, // MO approved, Awaiting QM tech approval
            'qm-approved' => 3, // QM tech Approved, Awaiting OC tech approval
            'approved' => 4, // OC Or CO tech Approved, Awaiting QM  issuance
            'qm-issued' => 5, // QM tech Issued the item
            'mo-declined' => 6, // MO has rejected
            'qm-declined' => 7, // QM has rejected
            'declined' => 8, // OC or CO has rejected
        ];
        return self::checkState($state,$statuses);
    }


    public static function getUserStatus($state)
    {
        $statuses = [
            'pending' => 0,
            'active'=>1,
            'revoked'=>2
        ];
        return self::checkState($state,$statuses);
    }

    public static function checkState($state,$statuses){
        try {
            if (is_numeric($state))
                $statuses = array_flip($statuses);
            if(is_array($state)){
                $states  = [];
                foreach($state as $st) {
                    $states[] = $statuses[$st];
                }
                return $states;
            }
            return $statuses[$state];
        }catch (\Exception $e){
            return 'N/A';
        }
    }
}

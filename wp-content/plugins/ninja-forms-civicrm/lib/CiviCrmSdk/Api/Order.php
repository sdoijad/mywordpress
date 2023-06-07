<?php 
namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Order as ContractsOrder;
use NinjaForms\CiviCrmShared\Entities\HandledResponse;


class Order implements ContractsOrder{

    public function createOrder(?array $parameterArray): HandledResponse{

        $handledResponse = HandledResponse::fromArray([]);

            try{

                $orderResult = \civicrm_api3('Order', 'create', $parameterArray);
            }catch(\Exception $e){
                update_option('exeptionresult',$e->getMessage());
            }


        return $handledResponse;

    }
}

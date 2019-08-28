<?php

namespace Aimeos\MShop\Service\Provider\Payment;
 
class Invoice
	extends \Aimeos\MShop\Service\Provider\Payment\Base
	implements \Aimeos\MShop\Service\Provider\Payment\Iface
{
    /**
     * Tries to get an authorization or captures the money immediately for the given
     * order if capturing isn't supported or not configured by the shop owner.
     *
     * @param \Aimeos\MShop\Order\Item\Iface $order Order invoice object
     * @param array $params Request parameter if available
     * @return \Aimeos\MShop\Common\Item\Helper\Form\Standard Form object with URL, action
     *  and parameters to redirect to	(e.g. to an external server of the payment
     *  provider or to a local success page)
     */
    public function process( \Aimeos\MShop\Order\Item\Iface $order, array $params = array() )
	{
		
    
	}

	public function updateSync( \Psr\Http\Message\ServerRequestInterface $request, \Aimeos\MShop\Order\Item\Iface $order )
	{
		// extract status from the request
		// map the status value to one of the Aimeos payment status values
	 
		$order->setPaymentStatus( $status );
		$this->saveOrder( $order );
	 
		return $order;
	}

	public function updatePush( \Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response )
	{
		// extract the order ID and latest status from the request
		$order = $this->getOrder( $orderid );
		// map the status value to one of the Aimeos payment status values
	 
		$order->setPaymentStatus( $status );
		$this->saveOrder( $order );
	 
		return $response;
	}

	public function updateAsync()
	{
		// extract the order IDs and latest status values from the file
	 
		foreach( $entries as $orderid => $status )
		{
			// map the status value to one of the Aimeos payment status values
	 
			$order = $this->getOrder( $orderid );
			$order->setPaymentStatus( $status );
			$this->saveOrder( $order );
		}
	}

}
?>

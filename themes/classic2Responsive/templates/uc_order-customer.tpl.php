

<body link="#76882f" vlink="#76882f" alink="#76882f">
	<?php
// $Id: uc_order-customer.tpl.php,v 1.1.2.1 2010/07/16 15:45:09 islandusurper Exp $

/**
 * @file
 * This file is the default customer invoice template for Ubercart.
 */
?>
	<table width="95%" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#76882F" style="font-family: verdana, arial, helvetica; font-size: small;">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF" style="font-family: verdana, arial, helvetica; font-size: small;">
					<?php if ($business_header) { ?>
					<tr valign="top">
						<td>
							<table width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
								<tr>
									<td><?php echo $site_logo; ?></td>
									<td width="98%">
										<div style="padding-left: 1em;">
											<span style="font-size: large;"><?php echo $store_name; ?></span><br />
											<?php echo $site_slogan; ?></div>
									</td>
									<td nowrap="nowrap"><?php echo $store_address; ?><br />
										<?php echo $store_phone; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<?php } ?>
					<tr valign="top">
						<td><?php if ($thank_you_message) { ?>
							<p><b><?php echo t('Thank you for your transaction, !order_first_name!', array('!order_first_name' => $order_first_name)); ?></b></p>
							<?php if (isset($_SESSION['new_user'])) { ?>
							<p><b><?php echo t('An account has been created for you with the following details:'); ?></b></p>
							<p><b><?php echo t('Username:'); ?></b> <?php echo $new_username; ?><br />
								<b><?php echo t('Password:'); ?></b> <?php echo $new_password; ?></p>
							<?php } ?><?php } ?>
							<table cellpadding="4" cellspacing="0" border="0" width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
								<tr>
									<td colspan="2" bgcolor="#76882F" style="color: white;"><b><?php echo t('Transaction Details:'); ?></b></td>
								</tr>
								<tr>
									<td nowrap="nowrap"><b><?php echo t('E-mail Address:'); ?></b></td>
									<td width="98%"><?php echo $order_email; ?></td>
								</tr>
								<tr>
									<td colspan="2">
										<table width="100%" cellspacing="0" cellpadding="0" style="font-family: verdana, arial, helvetica; font-size: small;">
											<tr>
												<td valign="top" width="50%"><b><?php echo t('Billing Address:'); ?></b><br />
													<?php echo $order_billing_address; ?><br />
													<br />
													<b><?php echo t('Billing Phone:'); ?></b><br />
													<?php echo $order_billing_phone; ?><br />
												</td>
												<?php if (uc_order_is_shippable($order)) { ?>
												<td valign="top" width="50%"><b><?php echo t('Shipping Address:'); ?></b><br />
													<?php echo $order_shipping_address; ?><br />
													<br />
													<b><?php echo t('Shipping Phone:'); ?></b><br />
													<?php echo $order_shipping_phone; ?><br />
												</td>
												<?php } ?></tr>
										</table>
									</td>
								</tr>
								<tr>
									<td nowrap="nowrap"><b><?php echo t('Order Grand Total:'); ?></b></td>
									<td width="98%"><b><?php echo $order_total; ?></b></td>
								</tr>
								<tr>
									<td nowrap="nowrap"><b><?php echo t('Payment Method:'); ?></b></td>
									<td width="98%"><?php echo $order_payment_method; ?></td>
								</tr>
								<tr>
									<td colspan="2" bgcolor="#76882F" style="color: white;"><b><?php echo t('Summary:'); ?></b></td>
								</tr>
								<?php if (uc_order_is_shippable($order)) { ?>
								<tr>
									<td colspan="2" bgcolor="#EEEEEE"><font color="#CC6600"><b><?php echo t('Shipping Details:'); ?></b></font></td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="2">
										<table border="0" cellpadding="1" cellspacing="0" width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
											<tr>
												<td nowrap="nowrap"><b><?php echo t('Transaction #:'); ?></b></td>
												<td width="98%"><?php echo $order_link; ?></td>
											</tr>
											<tr>
												<td nowrap="nowrap"><b><?php echo t('Transaction Date: '); ?></b></td>
												<td width="98%"><?php echo $order_date_created; ?></td>
											</tr>
											<?php if ($shipping_method && uc_order_is_shippable($order)) { ?>
											<tr>
												<td nowrap="nowrap"><b><?php echo t('Shipping Method:'); ?></b></td>
												<td width="98%"><?php echo $order_shipping_method; ?></td>
											</tr>
											<?php } ?>
											<tr>
												<td nowrap="nowrap"><?php echo t('Subtotal:'); ?>&nbsp;
                      </td>
												<td width="98%"><?php echo $order_subtotal; ?></td>
											</tr>
											<?php
                    $context = array(
                      'revision' => 'themed',
                      'type' => 'line_item',
                      'subject' => array(
                        'order' => $order,
                      ),
                    );
                    foreach ($line_items as $item) {
                    if ($item['line_item_id'] == 'subtotal' || $item['line_item_id'] == 'total') {
                      continue;
                    }?>
											<tr>
												<td nowrap="nowrap"><?php echo $item['title']; ?>:
                      </td>
												<td><?php
                          $context['subject']['line_item'] = $item;
                          echo uc_price($item['amount'], $context);
                        ?></td>
											</tr>
											<?php } ?>
											<tr>
												<td>&nbsp;</td>
												<td>------</td>
											</tr>
											<tr>
												<td nowrap="nowrap"><b><?php echo t('Total for this Transaction:'); ?>&nbsp;</b></td>
												<td><b><?php echo $order_total; ?></b></td>
											</tr>
											<tr>
												<td colspan="2"><br />
													<br />
													<b><?php echo t('Products on order:'); ?>&nbsp;</b>
													<table width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
														<?php if (is_array($order->products)) {
                            $context = array(
                              'revision' => 'formatted',
                              'type' => 'order_product',
                              'subject' => array(
                                'order' => $order,
                              ),
                            );
                            foreach ($order->products as $product) {
                              $price_info = array(
                                'price' => $product->price,
                                'qty' => $product->qty,
                              );
                              $context['subject']['order_product'] = $product;
                              $context['subject']['node'] = node_load($product->nid);
                              ?>
														<tr>
															<td valign="top" nowrap="nowrap"><b><?php echo $product->qty; ?> x </b></td>
															<td width="98%"><b><?php echo $product->title .' - '. uc_price($price_info, $context); ?></b>
                              <?php if ($product->qty > 1) {
                                $price_info['qty'] = 1;
                                echo t('(!price each)', array('!price' => uc_price($price_info, $context)));
                              } ?><br />
																<?php echo t('SKU: ') . $product->model; ?><br />
																<?php if (is_array($product->data['attributes']) && count($product->data['attributes']) > 0) {?><?php foreach ($product->data['attributes'] as $attribute => $option) {
                                echo '<li>'. t('@attribute: @options', array('@attribute' => $attribute, '@options' => implode(', ', (array)$option))) .'</li>';
                              } ?><?php } ?><br />
															</td>
														</tr>
														<?php }
                              }?>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php if ($help_text || $email_text || $store_footer) { ?>
								<tr>
									<td colspan="2">
										<hr noshade="noshade" size="1" />
										<br />
										<?php if ($help_text) { ?>
											<p><?php echo $store_link; ?></p>
										<?php } ?><?php if ($email_text) { ?>
										<p><?php echo t('Please note: This e-mail message is an automated notification. Please do not reply to this message.'); ?></p>
										<p><?php echo t('Thank you!'); ?></p>
										<?php } ?><?php if ($store_footer) { ?>
										<p><b><?php echo $store_link; ?></b><br />
											<b><?php echo $site_slogan; ?></b></p>
										<?php } ?></td>
								</tr>
								<?php } ?>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>



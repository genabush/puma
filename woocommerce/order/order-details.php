<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! $order = wc_get_order( $order_id ) ) {
    return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
    wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}
?>
    <section class="woocommerce-order-details">
        <?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

        <!--	<h2 class="woocommerce-order-details__title">--><?php //_e( 'Order details', 'woocommerce' ); ?><!--</h2>-->

        <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

            <thead>
            <tr>
                <th colspan="2" class="woocommerce-table__product-name product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
                <th class="woocommerce-table__product-table product-total"><?php _e( 'Price', 'woocommerce' ); ?></th>
                <th class="woocommerce-table__product-table product-total">#</th>
                <th class="woocommerce-table__product-table product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
            </tr>
            </thead>

            <tbody>
            <?php
            do_action( 'woocommerce_order_details_before_order_table_items', $order );

            foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product();

                wc_get_template( 'order/order-details-item.php', array(
                    'order'			     => $order,
                    'item_id'		     => $item_id,
                    'item'			     => $item,
                    'show_purchase_note' => $show_purchase_note,
                    'purchase_note'	     => $product ? $product->get_purchase_note() : '',
                    'product'	         => $product,
                ) );
            }
            do_action( 'woocommerce_order_details_after_order_table_items', $order );
            ?>
            </tbody>

            <tfoot>
            <?php
            $total = $order->get_order_item_totals();
            $country_code = '---';
            $rates = WC_Tax::find_rates( array( 'country' => $country_code ) );
            foreach( $rates as $rate ){
                $tax_rate_name = ' ' . $rate['rate'] . '%';
            }
            ?>
            <tr>
                <th colspan="4" scope="row" class="thankyou-subtotal"><?php echo $total['cart_subtotal']['label']; ?></th>
                <td class="thankyou-subtotal"><?php echo $total['cart_subtotal']['value']; ?></td>
            </tr>
            <tr>
                <th colspan="4" scope="row" ><?php echo $total['shipping']['label']; ?></th>
                <td><?php echo $total['shipping']['value']; ?></td>
            </tr>
            <tr>
                <th colspan="4" scope="row" ><?php echo str_replace(':', $tax_rate_name, $total['tax']['label']); ?></th>
                <td><?php echo $total['tax']['value']; ?></td>
            </tr>
            <tr>
                <th colspan="4" scope="row" ><?php echo $total['payment_method']['label']; ?></th>
                <td><?php echo $total['payment_method']['value']; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="thankyou-total-hide"></td>
                <td class="thankyou-total"><?php echo $total['order_total']['value']; ?></td>
            </tr>
            <?php
            /*}*/
            ?>
            <?php /*if ( $order->get_customer_note() ) : */?>
            <!--				<tr>-->
            <!--					<th>--><?php ///*_e( 'Note:', 'woocommerce' ); */?><!--</th>-->
            <!--					<td>--><?php ///*echo wptexturize( $order->get_customer_note() ); */?><!--</td>-->
            <!--				</tr>-->
            <?php /*endif; */?>
            </tfoot>
        </table>

        <?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
    </section>

<?php
/*if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}*/

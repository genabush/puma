<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
    return;
}
?>
<tr class="thankyou-page <?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

    <td class="product-thumbnail">
        <?php
        $is_visible        = $product && $product->is_visible();
        $product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
        /* add product image */
        ?>      <div> <?php
            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $cart_item, $cart_item_key );

            if ( ! $product_permalink ) {
                echo wp_kses_post( $thumbnail );
            } else {
                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
            }
            ?>
        </div>
    </td>
    <td class="woocommerce-table__product-name product-name product-name-another" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
        <?php
        /* add product image end */
        echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible );
        //			echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item );

        do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

        //			wc_display_item_meta( $item );

        do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
        ?>
    </td>
    <td data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>"><?php
        /* price */
        echo  $product->get_price_html();

        ?></td>
    <td data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>"><?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item ); ?></td>
    <td class="woocommerce-table__product-total product-total" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
        <?php echo $order->get_formatted_line_subtotal( $item ); ?>
    </td>

</tr>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

    <tr class="woocommerce-table__product-purchase-note product-purchase-note">

        <td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

    </tr>

<?php endif; ?>














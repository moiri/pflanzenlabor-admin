<?php
require_once __DIR__ . '/../page.php';

/**
 * Orders Component Class
 */
class Orders extends Page {
    private $db;
    private $packet_orders;
    private $packet_headers;

    function __construct( $router, $db ) {
        parent::__construct( $router );
        $this->db = $db;
        $this->append_js_includes('orders.js');
        $this->packet_orders = $this->fetch_orders();
        $this->packet_headers = array(
            array(
                "key" => "is_gift",
                "header" => "Geschenk Abo",
                "fa" => "gift",
            ),
            array(
                "key" => "comment",
                "header" => "Kommentar",
                "css" => "text-prewrap"
            ),
            array(
                "key" => "is_partner",
                "header" => "Partner Abo",
                "fa" => "user-friends",
            ),
            array(
                "key" => "order_date",
                "header" => "Bestelldatum",
            ),
            array(
                "key" => "email",
                "header" => "Email",
            ),
            array(
                "key" => "phone",
                "header" => "Telefon",
            ),
            array(
                "key" => "b_address",
                "header" => "Rechungs Adresse",
                "css" => "text-prewrap"
            ),
            array(
                "key" => "d_address",
                "header" => "Liefer Adresse",
                "css" => "text-prewrap"
            ),
            array(
                "key" => "payment",
                "header" => "Bezahlung",
            ),
            array(
                "key" => "id",
                "header" => "Bestellnummer",
            ),
        );
    }

    private function fetch_orders() {
        $sql = "SELECT upo.id AS id, upo.order_date, u.email, u.phone, upo.comment, pay.type AS payment, upo.id_packets, upo.id_payment,
            CONCAT(first_name, ' ', last_name, '\n', street, ' ', street_number, '\n', zip, ' ', city) AS b_address,
            CONCAT(d_first_name, ' ', d_last_name, '\n', d_street, ' ', d_street_number, '\n', d_zip, ' ', d_city) AS d_address,
            CONCAT(g_first_name, ' ', g_last_name, '\n', g_street, ' ', g_street_number, '\n', g_zip, ' ', g_city) AS g_address
            FROM user_packets_order AS upo
            LEFT JOIN user AS u ON u.id = upo.id_user
            LEFT JOIN packets AS p ON p.id = upo.id_packets
            LEFT JOIN payment AS pay ON pay.id = upo.id_payment
            WHERE upo.is_ordered = 1 AND id_packets != :id_single";
        $res_db = $this->db->queryDb( $sql,
            array( 'id_single' => ID_PACKET_SINGLE ) );
        $res = array();
        foreach( $res_db as $item )
        {
            $res_item = $item;
            $res_item['id'] = intval( $res_item['id'] );
            $res_item['is_gift'] = false;
            $res_item['is_partner'] = false;
            $res_item['is_payed'] = true;
            if( $item['id_payment'] == PAYMENT_PAYPAL )
                $res_item['is_payed'] = $item['is_payed'] == 1;
            if( $item['id_packets'] == ID_PACKET_GIFT_SOLO )
            {
                $res_item['is_gift'] = true;
                if( $item['g_address'] != "" )
                    $res_item['d_address'] = $item['g_address'];
            }
            else if( $item['id_packets'] == ID_PACKET_GIFT_PARTNER )
            {
                array_push( $res, $res_item );
                $res_item['is_gift'] = true;
                if( $item['g_address'] != "" )
                    $res_item['d_address'] = $item['g_address'];
            }
            else if( $item['id_packets'] == ID_PACKET_PARTNER )
            {
                $res_item['is_partner'] = true;
            }
            array_push( $res, $res_item );
        }
        return $res;
    }

    private function print_packet_headers()
    {
        foreach($this->packet_headers as $item)
        {
            $key = $item['key'];
            $header = isset( $item['fa']) ? "" : $item['header'];
            require __DIR__ . "/v_table_header.php";
        }
    }

    private function print_packet_orders()
    {
        foreach( $this->packet_orders as $order)
        {
            $css = "";
            if($order['is_payed'] === "0")
                $css = "table-warning";
            require __DIR__ . "/v_packet_order.php";
        }
    }

    private function print_packet_order($order)
    {
        foreach($this->packet_headers as $header)
        {
            $item = trim($order[$header['key']], " ,");
            $css = isset($header['css']) ? $header['css'] : "";
            if( isset( $header['fa'] ) && $item != "")
                $item = '<i class="fas fa-' . $header['fa'] . '" title="' . $header['header'] . '"></i>';
            require __DIR__ . "/v_table_item.php";
        }
    }

    /** PUBLIC METHODS ********************************************************/

    public function print_view() {
        $this->print_page( function() {
            require __DIR__ . '/v_orders.php';
        } );
    }

}

<?php
require_once __DIR__ . '/../page.php';

/**
 * Impressions Component Class
 */
class Impressions extends Page {
    private $db;
    private $item_imp = array();
    private $item_cont = array();

    function __construct( $router, $db, $id_imp=null, $id_cont=null ) {
        parent::__construct( $router );
        $this->db = $db;
        $this->append_js_includes('impressions.js');

        $res_i = $this->update_impressions($_POST['impressions'] ?? null, $id_imp);
        $res_ip = $this->update_positions_impressions($_POST['positions-impressions'] ?? null);
        $this->item_imp['id'] = null;
        if($id_imp !== null)
        {
            $sql = "SELECT * FROM impressions WHERE id = :id";
            $this->item_imp = $this->db->queryDbFirst($sql, array(':id' => $id_imp));
        }
        $this->item_imp['update'] = $res_i;
        $this->item_imp['update_p'] = $res_ip;

        $res_c = $this->update_impressions_content($_POST['impressions_content'] ?? null, $id_cont);
        $res_f = $this->update_impressions_fields($_POST['impressions_fields'] ?? null, $id_cont);
        $res_cp = $this->update_positions_content($_POST['positions-impressions_content'] ?? null, $id_imp);
        $this->item_cont['id'] = null;
        if($id_cont !== null)
        {
            $sql = "SELECT id, name FROM impressions_content
                WHERE id = :id";
            $this->item_cont = $this->db->queryDbFirst($sql, array(':id' => $id_cont));
            $sql = "SELECT i.id, i.content, it.name AS type FROM impressions_fields AS i
                LEFT JOIN impressions_content AS ic ON ic.id = i.id_impressions_content
                LEFT JOIN impressions_fields_type AS it ON it.id = i.id_type
                WHERE i.id_impressions_content = :id";
            $this->item_cont['fields'] = $this->db->queryDb($sql, array(':id' => $id_cont));
        }
        $this->item_cont['update'] = $res_c ?? $res_f ?? null;
        if($res_c !== null && $res_f !== null)
            $this->item_cont['update'] = $res_c & $res_f;
        $this->item_cont['update_p'] = $res_cp;
    }

    private function update_impressions($data, $id)
    {
        if($data === null || $id === null)
            return null;
        if($data['id_class'] === "null")
            $data['id_class'] = null;
        return $this->db->updateByUid('impressions', $data, $id);
    }

    private function update_impressions_content($data, $id)
    {
        if($data === null || $id === null)
            return null;
        return $this->db->updateByUid('impressions_content', $data, $id);
    }

    private function update_impressions_fields($data, $id)
    {
        if($data === null || $id === null)
            return null;
        $res = true;
        foreach($data as $key => $items)
            $res &= $this->db->updateByUid('impressions_fields', $items, $key);
        return $res;
    }

    private function update_positions_impressions($data)
    {
        if($data === null)
            return null;
        $orders = explode(',', $data);
        $sql = "SELECT * FROM impressions ORDER BY position";
        $items = $this->db->queryDb($sql);
        $res = true;
        foreach($items as $idx => $item)
            $res &= $this->db->updateByUid("impressions",
                array("position" => $orders[$idx]), $item['id']);
        return $res;
    }

    private function update_positions_content($data, $id)
    {
        if($data === null || $id === null)
            return null;
        $orders = explode(',', $data);
        $sql = "SELECT * FROM impressions_content WHERE id_impressions = :id
            ORDER BY position";
        $items = $this->db->queryDb($sql, array(':id' => $id));
        $res = true;
        foreach($items as $idx => $item)
            $res &= $this->db->updateByUid("impressions_content",
                array("position" => $orders[$idx]), $item['id']);
        return $res;
    }

    private function print_class_selection()
    {
        $sql = "SELECT id, name FROM classes ORDER BY name";
        $classes = $this->db->queryDb($sql);
        foreach($classes as $class)
        {
            $selected = "";
            if($this->item_imp['id_class'] == $class['id'])
                $selected = ' selected="selected"';
            echo '<option value="' . $class['id'] . '"' . $selected . '>' . $class['name'] . '</option>';
        }
    }

    private function print_content()
    {
        if($this->item_imp['id'] === null)
            return;
        $sql = "SELECT ic.id, ic.name AS title, ict.name AS code
            FROM impressions_content AS ic
            LEFT JOIN impressions_content_type AS ict ON ic.id_type = ict.id
            WHERE id_impressions = :id
            ORDER BY position";
        $content = $this->db->queryDb($sql, array(':id' => $this->item_imp['id']));
        foreach($content as $key => $item)
        {
            $content[$key]['url'] = $this->router->generate('impressions',
                array('id_imp' => intval($this->item_imp['id']),
                'id_cont' => intval($item['id']))) . '#impression-content-form';
        }
        $this->print_list($content, "list-content", $this->item_cont['id']);
    }

    private function print_impressions()
    {
        $sql = "SELECT i.id, i.title, c.name FROM impressions AS i
            LEFT JOIN classes AS c ON c.id = i.id_class
            ORDER BY position";
        $impressions = $this->db->queryDb($sql);
        foreach($impressions as $key => $item)
        {
            if($item['title'] == "")
                $impressions[$key]['title'] = $item['name'];
            if($item['name'] != "")
                $impressions[$key]['code'] = $item['name'];
            $impressions[$key]['url'] = $this->router->generate('impressions',
                array('id_imp' => intval($item['id']))) . '#impression-form';
        }
        $this->print_list($impressions, "list-impressions", $this->item_imp['id']);
    }

    private function print_impression_alert($update)
    {
        if($update === null)
            return;
        if($update)
            require __DIR__ . "/v_impression_alert_success.php";
        else
            require __DIR__ . "/v_impression_alert_fail.php";
    }

    private function print_impression_form()
    {
        if($this->item_imp['id'] === null)
            return;
        require __DIR__ . "/v_impression_form.php";
    }

    private function print_impression_content_form()
    {
        if($this->item_cont['id'] === null)
            return;
        require __DIR__ . "/v_impression_content_form.php";
    }

    private function print_impression_content_form_fields()
    {
        foreach($this->item_cont['fields'] as $item)
        {
            $name = $item['type'];
            $value = $item['content'];
            $id = intval($item['id']);
            require __DIR__ . "/v_impression_content_form_field.php";
        }
    }

    private function print_impression_content_form_field($id, $value, $type)
    {
        if($type === "cite")
            require __DIR__ . "/v_impression_content_form_textarea.php";
        else
            require __DIR__ . "/v_impression_content_form_input.php";
    }

    private function print_list($items, $id="", $active_id=null)
    {
        if($items === null)
            return;
        require __DIR__ . "/v_list.php";
    }
    private function print_list_item_code($code)
    {
        if($code === null)
            return;
        require __DIR__ . "/v_list_item_code.php";
    }

    private function print_list_items($items, $active_id)
    {
        foreach($items as $idx => $item)
        {
            $id = intval($item['id']);
            $name = $item['title'];
            $code = null;
            if($name == "")
                $name = $id;
            if(isset($item['code']))
                $code = $item['code'];
            if(isset($item['url']))
            {
                $active = "";
                if($id == $active_id)
                    $active = "active";
                $url = $item['url'];
                require __DIR__ . "/v_list_item_url.php";
            }
            else
                require __DIR__ . "/v_list_item.php";
        }
    }

    private function print_position_form($id)
    {
        require __DIR__ . '/v_position_form.php';
    }

    public function print_view() {
        $this->print_page( function() {
            require __DIR__ . '/v_impressions.php';
        } );
    }
}

?>

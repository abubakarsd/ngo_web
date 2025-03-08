<?php
include_once('connect.php');
$output = '';
try {
    $sql = "SELECT * FROM priorities";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (empty($result)) {
        $output .= '<tr><td colspan="7">No priorities for now</td></tr>';
    } else {
        foreach ($result as $row) {
            $output .= '
            <tr>
            <td class="footable-first-visible" style="display: table-cell;">'.$row['icon'].'</td>
            <td style="display: table-cell;">'.$row['title'].'</td>
            <td style="display: table-cell;">'.$row['short_text'].'</td>
            <td class="footable-last-visible" style="display: table-cell;">
                <a href="#" class="btn btn-default waves-effect waves-float waves-green btn_edit_priorities" id="'.$row['id'].'"><i class="zmdi zmdi-edit"></i></a>
                <a href="#" class="btn btn-default waves-effect waves-float waves-red btn_delete_priorities" id="'.$row['id'].'"><i class="zmdi zmdi-delete"></i></a>
            </td>
            </tr>
            ';
        }
    }
} catch (PDOException $e) {
    $output .= $e->getMessage();
}
echo $output;
?>
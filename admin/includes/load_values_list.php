<?php
include_once('connect.php');
$output = '';

try {
    $sql = "SELECT id, icon, title, details, date_add FROM tbl_values";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (empty($result)) {
        $output .= '<tr><td colspan="5">No records found</td></tr>';
    } else {
        foreach ($result as $row) {
            $output .= '
            <tr>
                <td class="footable-first-visible" style="display: table-cell;">' . $row['icon'] . '</td>
                <td style="display: table-cell;">' . htmlspecialchars($row['title']) . '</td>
                <td style="display: table-cell;">' . htmlspecialchars($row['details']) . '</td>
                <td class="footable-last-visible" style="display: table-cell;">
                    <a href="#" class="btn btn-default waves-effect waves-float waves-green btn_edit_values" id="' . $row['id'] . '"><i class="zmdi zmdi-edit"></i></a>
                    <a href="#" class="btn btn-default waves-effect waves-float waves-red btn_delete_values" id="' . $row['id'] . '"><i class="zmdi zmdi-delete"></i></a>
                </td>
            </tr>
            ';
        }
    }
} catch (PDOException $e) {
    $output .= '<tr><td colspan="5">Error: ' . $e->getMessage() . '</td></tr>';
}

echo $output;
?>
<?php
include_once('connect.php');
$output = '';
try {
    $sql = "SELECT * FROM testimonials";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (empty($result)) {
        $output .= '<tr><td colspan="7">No Testimonials for now</td></tr>';
    } else {
        foreach ($result as $row) {
            $output .= '
            <tr>
            <td class="footable-first-visible" style="display: table-cell;">'.$row['title'].'</td>
            <td style="display: table-cell;">'.$row['text'].'</td>
            <td style="display: table-cell;">'.$row['name'].'</td>
            <td style="display: table-cell;">'.$row['role'].'</td>
            <td style="display: table-cell;"><img src="../static/media/'.$row['image'].'" width="48" alt="'.$row['title'].'"></td>
            <td style="display: table-cell;">'.$row['rating'].'</td>
            <td class="footable-last-visible" style="display: table-cell;">
                <a href="#" class="btn btn-default waves-effect waves-float waves-green btn_edit_testimonial" id="'.$row['id'].'"><i class="zmdi zmdi-edit"></i></a>
                <a href="#" class="btn btn-default waves-effect waves-float waves-red btn_delete_testimonial" id="'.$row['id'].'"><i class="zmdi zmdi-delete"></i></a>
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
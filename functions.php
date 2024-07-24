<?php






function format_date($time): string
{
    $time = strtotime($time);
    $month = date('M', $time);
    $day = date('d', $time);
    $year = date('Y', $time);

    return $day . ', ' . $month . ' ' . $year;
}


function get_category(PDO $conn, $id)
{
    global $dbname;
    $sql = "SELECT * FROM $dbname.categories WHERE id = :id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('id', $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    if (!$stmt->rowCount() > 0) {
        return "no category";
    }
    return $data->name;
}

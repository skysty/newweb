<?php
    include('../incs/connect.php');

    if (isset($_POST['id'])) {
        $engbekID = mysqli_real_escape_string($connection, $_POST['id']);

        // Check the value of divBall
        $sql = "SELECT divBall FROM engbekter WHERE engbekID = '$engbekID'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $divBall = $row['divBall'];

            // Update the record based on divBall value
            if ($divBall >= 1 && $divBall <= 9) {
                echo json_encode(array('success' => false, 'message' => 'Кешіріңіз 2.1 -2.6.1 аралығындағы көрсеткіштерге салынған еңбек өшірілмейді'));
            } else {
                $updateSql = "UPDATE engbekter SET del = 1 WHERE engbekID = '$engbekID'";
                $updateResult = mysqli_query($connection, $updateSql);

                if ($updateResult) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Жазбаны жаңарту мүмкін болмады'));
                }
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Жазба табылмады'));
        }
    }

    mysqli_close($connection);
?>

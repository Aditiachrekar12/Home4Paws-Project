<?php
include("partials/menu.php")
    ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper text-center">
        <h3 class="text-center all-caps">Helpline</h3>
        <br>
        <br>

        <div class="table-responsive-helpline">
            <table class="tbl">
                <tr>
                    <th>SI</th>
                    <th>Person's Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Pet Type</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_vc ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $phone_number = $row['phone_number'];
                        $email = $row['email'];
                        $pet_type = $row['pet_type'];
                        $details = $row['address'];
                        ?>
                        <tr>
                            <td class="tbl-adopt"><?php echo $sn++; ?></td>
                            <td class="tbl-adopt"><?php echo $name; ?></td>
                            <td class="tbl-adopt"><?php echo $phone_number; ?></td>
                            <td class="tbl-adopt"><?php echo $email; ?></td>
                            <td class="tbl-adopt"><?php echo $pet_type; ?></td>
                            <td class="tbl-adopt"><?php echo $details; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>rooms.php?phone_number=<?php echo $phone_number; ?>"
                                    class="btn_primary"> Chat</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='error'>No Helpline Requests Available</td></tr>";
                }
                ?>
            </table>
        </div>

    </div>
    <!-- Main Content Section Ends -->

    </body>

    </html>
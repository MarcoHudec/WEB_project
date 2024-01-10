<?php
require_once("databaseScript/dbaccess.php");
?>

<html lang="en">

<head>
    <?php include("includes/adminhead.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Useradmin</title>
    <style>
        .user-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
        }

        .fixed-width-table {
            width: 100%;
            /* Setzt die Breite der Tabelle auf 100% des Elternelements */
            table-layout: fixed;
            /* Ermöglicht gleichmäßige Spaltenbreiten */
            word-wrap: break-word;
            /* Stellt sicher, dass lange Wörter innerhalb der Zelle umgebrochen werden */
            overflow: hidden;
            /* Verhindert, dass Inhalt aus der Zelle herausragt */
            text-align: center;
            /* Ausrichtung des Textes */
        }
    </style>
</head>

<body>
    <?php include("includes/navbaradmin.php") ?>
    <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="container">
            <h1 class="custom-heading text-center">
                Users
            </h1>
            <?php
        //if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $query = "SELECT * FROM users ORDER BY id ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->bind_result($userid, $username, $userpassword, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus);

        while ($stmt->fetch()) {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="user-card">
                        <table class="table fixed-width-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>E-Mail</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $userid; ?>
                                    </td>
                                    <td>
                                        <?php echo $username; ?>
                                    </td>
                                    <td>
                                        <?php echo $useremail; ?>
                                    </td>
                                    <td>
                                        <?php echo $userfirstname; ?>
                                    </td>
                                    <td>
                                        <?php echo $userlastname; ?>
                                    </td>
                                    <td>
                                        <?php echo ($userrole == 'user') ? 'User' : 'Admin'; ?>
                                    </td>
                                    <td>
                                        <?php echo ($userstatus == 'active') ? 'Active' : 'Inactive'; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <div style="display: flex; justify-content: center; gap: 100px;">
                                <form method="post" action="userEdit.php">
                                    <input type="hidden" name="edit_user_id" value="<?php echo $userid; ?>">
                                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                                    <input type="hidden" name="useremail" value="<?php echo $useremail; ?>">
                                    <input type="hidden" name="userfirstname" value="<?php echo $userfirstname; ?>">
                                    <input type="hidden" name="userlastname" value="<?php echo $userlastname; ?>">
                                    <input type="hidden" name="usersalutation" value="<?php echo $usersalutation; ?>">
                                    <input type="hidden" name="userrole" value="<?php echo $userrole; ?>">
                                    <input type="hidden" name="userstatus" value="<?php echo $userstatus; ?>">
                                    <button type="submit" class="btn btn-primary">Edit User</button>
                                </form>

                                <form method="post" action="specificUserBookings.php?user_id=<?php echo $userid; ?>">
                                    <input type="hidden" name="edit_user_id" value="<?php echo $userid; ?>">
                                    <button type="submit" class="btn btn-primary">This users reservations</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        $stmt->close();
        //}
        ?>

        </div>
    </div>
    <?php include("includes/scripts.php") ?>
</body>

</html>